<?php

namespace App\Admin\Controllers;

use App\Models\FishRechargeLog;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FishRechargeLogController extends Controller
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
        return Admin::grid(FishRechargeLog::class, function (Grid $grid) {

            $grid->ID('ID')->sortable();
            $grid->OrderStates('订单状态');
            $grid->UserID('玩家ID');
            $grid->Price('价格');
            $grid->OldGlobelNum('充前金币');
            $grid->OldCurrceyNum('充前钻石');
            $grid->orderid('订单ID');
            $grid->channelOrderid('渠道订单ID');
            $grid->channelLabel('渠道名');
            $grid->ChannelCode('渠道码');
            $grid->ShopItemID('物品ID');
            $grid->AddGlobelSum('增加金币');
            $grid->AddCurrceySum('增加钻石');
            $grid->AddRewardID('奖励ID');
            $grid->LogTime('记录时间');

            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
            
                // 在这里添加字段过滤器
                $filter->equal('UserID', '玩家ID');
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
            $grid->disableCreation();
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
        return Admin::form(FishRechargeLog::class, function (Form $form) {

            $form->display('ID', 'ID');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

}
