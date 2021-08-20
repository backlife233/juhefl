<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\BatchCreateFriends;
use App\Models\Friend;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FriendController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Friend';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Friend());

        $grid->model()->orderByDesc('friend_id');

        $options = [
            'on'  => ['value' => 1, 'text' => '开启', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ];

        $grid->column('friend_id', __('Friend id'));
        $grid->column('user_id', __('User id'));
        $grid->column('user.name', __('User Name'));
        $grid->column('ico', __('Icon'))->image(null, 50, 50);
        $grid->column('name', __('Name'));
        $grid->column('link', __('Link'));
        $grid->column('domain', __('Domain'));
        $grid->column('sort', __('Sort'));
        $grid->column('status', __('Status'))->switch($options);
        $grid->column('lock', __('Lock'))->switch($options);
        $grid->column('category', __('Category'))->editable('select', Friend::CATEGORY);
        $grid->column('come', __('Come'));
        $grid->column('all_come', __('All come'));
        $grid->column('out', __('Out'));
        $grid->column('all_out', __('All out'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
            $create->text('name', __('Name'));
            $create->text('link', __('Link'));
            $create->select('category', __('Category'))->options(Friend::CATEGORY);
        });

        $grid->filter(function ($filter) {
            $filter->equal('user_id');
        });


        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new BatchCreateFriends());
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
        $show = new Show(Friend::findOrFail($id));

        $show->field('friend_id', __('Friend id'));
        $show->field('user_id', __('User id'));
        $show->field('name', __('Name'));
        $show->field('link', __('Link'));
        $show->field('domain', __('Domain'));
        $show->field('sort', __('Sort'));
        $show->field('status', __('Status'));
        $show->field('lock', __('Lock'));
        $show->field('category', __('Category'));
        $show->field('come', __('Come'));
        $show->field('all_come', __('All come'));
        $show->field('out', __('Out'));
        $show->field('all_out', __('All out'));
        $show->field('info', __('Info'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Friend());

        $options = [
            'on'  => ['value' => 1, 'text' => '开启', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ];

        $form->number('user_id', __('User id'))->default(0);
        $form->text('ico', __('Ico'));
        $form->text('name', __('Name'));
        $form->url('link', __('Link'));
        $form->text('domain', __('Domain'));
        $form->number('sort', __('Sort'))->default(0);
        $form->switch('status', __('Status'))->options($options)->default(1);
        $form->switch('lock', __('Lock'))->options($options)->default(0);
        $form->select('category', __('Category'))->options(Friend::CATEGORY);
        $form->number('come', __('Come'))->default(0);
        $form->number('all_come', __('All come'))->default(0);
        $form->number('out', __('Out'))->default(0);
        $form->number('all_out', __('All out'))->default(0);
        $form->textarea('info', __('Info'));

//        $form->saving(function (Form $form) {
//            $form->domain = parse_url($form->link)['host'] ?? null;
//        });

        return $form;
    }
}
