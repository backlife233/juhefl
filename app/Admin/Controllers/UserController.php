<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->model()->orderByDesc('id');

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('login_ip', __('Login ip'))->width(150);
        $grid->column('my_code', __('My code'));
        $grid->column('my_text', __('My text'))->display(function ($text) {
            $html = '';
            foreach ($text ?? [] as $item) {
                $html .= $item . '<br/>';
            }
            return $html;
        });
        $grid->column('vip_at', __('Vip at'));
        $grid->column('user_status', __('User status'))->switch([
            'on'  => ['value' => 1, 'text' => '开启', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ]);
        $grid->column('final_at', __('Final at'))->sortable();
        $grid->column('final_ip', __('Final ip'))->width(150);
        $grid->column('friends', __('Friends'))->display(function ($friends) {
            $html = '';

            foreach ($friends as $friend) {
                if ($friend) {
                    $html .= $friend['name'] . "，链接：" . $friend['link'] . "<br/>";
                }
            }
            return $html;
        });

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter) {
            $filter->equal('inviter_id');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('verified', __('Verified'));
        $show->field('coin', __('Coin'));
        $show->field('login_ip', __('Login ip'));
        $show->field('my_code', __('My code'));
        $show->field('my_text', __('My text'));
        $show->field('vip_at', __('Vip at'));
        $show->field('user_status', __('User status'));
        $show->field('inviter_id', __('Inviter id'));
        $show->field('final_at', __('Final at'));
        $show->field('final_ip', __('Final ip'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('avatar', __('Avatar'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->switch('verified', __('Verified'));
        $form->number('coin', __('Coin'));
        $form->text('login_ip', __('Login ip'));
        $form->text('my_code', __('My code'));
//        $form->text('my_text', __('My text'));
        $form->datetime('vip_at', __('Vip at'))->default(date('Y-m-d H:i:s'));
        $form->switch('user_status', __('User status'))->default(1);
        $form->number('inviter_id', __('Inviter id'));
        $form->datetime('final_at', __('Final at'))->default(date('Y-m-d H:i:s'));
        $form->text('final_ip', __('Final ip'));
        $form->image('avatar', __('Avatar'));

        return $form;
    }
}
