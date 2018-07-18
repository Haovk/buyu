<?php

namespace App\Admin\Controllers;

use App\Models\FishRoleTableInfo;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FishRoleTableInfoController extends Controller
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
        return Admin::grid(FishRoleTableInfo::class, function (Grid $grid) {

            $grid->UserID('玩家ID')->sortable();
            $grid->TableTypeID('桌子ID');
            $grid->TableMonthID('比赛ID');
            $grid->JoinGlobelNum('进入金币数');
            $grid->JoinMedalNum('进入奖牌数');
            $grid->JoinCurrceyNum('进入钻石数');
            $grid->JoinTableLogTime('进入时间');
            $grid->LeaveGlobelNum('离开金币数');
            $grid->LeaveMedalNum('离开奖牌数');
            $grid->LeaveCurrceyNum('离开钻石数');
            $grid->LeaveTableLogTime('离开时间');

            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
            
                // 在这里添加字段过滤器
                $filter->like('UserID', '玩家ID');
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
        return Admin::form(FishRoleTableInfo::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
