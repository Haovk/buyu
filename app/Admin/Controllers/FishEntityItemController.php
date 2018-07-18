<?php

namespace App\Admin\Controllers;

use App\Models\FishEntityItem;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FishEntityItemController extends Controller
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
        return Admin::grid(FishEntityItem::class, function (Grid $grid) {

            $grid->ID('订单ID')->sortable();
            $grid->UserID('玩家ID');
            $grid->ItemID('物品ID');
            $grid->ItemSum('数量');
            $grid->Address('地址');
            $grid->Phone('电话');
            $grid->Name('姓名');
            $grid->IDEntity('身份证号码');
            $grid->MedalNum('奖牌数量');
            $grid->NowMedalNum('剩余奖牌');
            $grid->ShopTime('提交时间');

            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
            
                // 在这里添加字段过滤器
                $filter->equal('UserID', '玩家ID');
            });

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
            
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();                
            });
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
        return Admin::form(FishEntityItem::class, function (Form $form) {

        });
    }
}
