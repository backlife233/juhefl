@extends('user.layout')

@section('user_title','我的订单')
@section('user_body')
    <div class="user_orders">
        <ul>
            @foreach($orders as $order)
                <li>
                    <div>订单编号：{{$order->out_trade_no}}</div>
                    <div>创建时间：{{$order->created_at}}</div>
                    <div>标题：永久赞助VIP</div>
                    <div>支付状态：{{$order->order_status_str}}</div>
                    <div>支付时间：{{$order->paid_at}}</div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
