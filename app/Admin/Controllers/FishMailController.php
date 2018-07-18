<?php

namespace App\Admin\Controllers;

use App\Models\FishMail;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Carbon\Carbon;

class FishMailController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(FishMail::class, function (Grid $grid) {

            $grid->MailID('ID')->sortable();
            $grid->SrcUserID('发送玩家');
            $grid->DestUserID('接收玩家');
            $grid->Context('邮件内容');
            $grid->IsRead('是否已读');
            $grid->RewardID('奖励ID');
            $grid->RewardSum('奖励数量');
            $grid->IsExistsReward('有否奖励');
            $grid->SendTime('发送时间');

            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
            
                // 在这里添加字段过滤器
                $filter->like('Context', '邮件内容');
            });
            
            // $grid->actions(function (Grid\Displayers\Actions $actions) {
            //     $actions->disableDelete();                
            // });
            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
            $grid->disableActions();
            //$grid->disableCreation();
            $grid->disableExport();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(FishMail::class, function (Form $form) {

            $form->number('DestUserID', '收件人ID');
            $form->number('RewardID', '奖励ID');
            $form->number('RewardSum', '奖励数量');
            $form->text('Context', '邮件内容');
            $form->hidden('SrcUserID', '发件人')->default(0);
            $form->hidden('IsRead', '是否已读')->default(0);
            $form->hidden('SendTime', '发生时间')->default(Carbon::now());
            $form->saving(function (Form $form) {
                $form->model()->IsExistsReward=0;
                if ($form->RewardID>0) {
                    $form->model()->IsExistsReward=1;
                }
            });
        });
    }
}
