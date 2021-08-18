<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\SDK\lib\AlipayNotify;
use App\SDK\lib\AlipaySubmit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function pay()
    {
        $alipay_config = config('alipay');

        $plan = config('custom.plan')['forever'];

        $out_trade_no = time() . Str::random(6);
        $money        = 50;
        $userId       = me()->getKey();

        if ($userId === 1) {
            $money = 1;
        }

        $parameter = array(
            "pid"          => $alipay_config['partner'],
            "type"         => request('type', 'wxpay'),
            "notify_url"   => route('pay.notify'),
            "return_url"   => route('pay.return'),
            "out_trade_no" => $out_trade_no,
            "name"         => '赞助',
            "money"        => $money,
            "sitename"     => '电竞人'
        );

        Order::create([
            'user_id'      => $userId,
            'out_trade_no' => $out_trade_no,
            'amount'       => $money,
            'plan'         => 'forever',
            'days'         => '9999999',
        ]);

        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text    = $alipaySubmit->buildRequestForm($parameter);
        echo $html_text;
    }

    public function notify()
    {
        Log::info('notify', request()->all());

        $alipay_config = config('alipay');
        $alipayNotify  = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if ($verify_result) {//验证成功
            $out_trade_no = $_GET['out_trade_no'];
            $trade_no     = $_GET['trade_no'];
            $trade_status = $_GET['trade_status'];
            //支付方式
            $type = $_GET['type'];

            $order = Order::where('out_trade_no', $out_trade_no)->first();
            if (is_null($order)) {
                echo 'fail';
            }

            if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                //如果有做过处理，不执行商户的业务程序

                if ($order->order_status !== 'success') {
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                    $result = $order->doFinish();
                    if ($result) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                }
            }
            echo "success";        //请不要修改或删除
        } else {
            //验证失败
            echo "fail";
        }
    }

    public function return()
    {
        Log::info('return', request()->all());

//        $mock = json_decode('{"money":"1","name":"kkk","out_trade_no":"1627025813Sl17N8T","pid":"23123","trade_no":"2000012415364687499","trade_status":"TRADE_SUCCESS","type":"alipay","sign":"bc85262c184848c35ab4de260d905f60","sign_type":"MD5"}', true);
//        $_GET = array_merge($_GET, $mock);

        $alipay_config = config('alipay');

        $alipayNotify  = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();

        if ($verify_result) {//验证成功
            $out_trade_no = $_GET['out_trade_no'];
            $trade_no     = $_GET['trade_no'];
            $trade_status = $_GET['trade_status'];
            $type         = $_GET['type'];

            $order = Order::where('out_trade_no', $out_trade_no)->first();
            if (is_null($order)) {
                return abort('400', '订单不存在');
            }

            if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                if ($order->order_status !== 'success') {
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
                    $result = $order->doFinish();
                    if ($result) {
                        return redirect(route('pay.page', ['code' => 'success']));
                    } else {
                        return redirect(route('pay.page', ['code' => 'error']));
                    }
                }
            } else {
                return redirect(route('pay.page', ['code' => 'error']));
            }

            return redirect(route('pay.page', ['code' => 'success']));
        } else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            return redirect(route('pay.page', ['code' => 'error']));
        }
    }

    public function page()
    {
        if (request('code') === 'success') {
            return abort(200, '支付成功');
        }
        return abort(400, '支付失败，请联系管理');
    }
}
