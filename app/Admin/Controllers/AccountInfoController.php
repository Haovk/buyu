<?php

namespace App\Admin\Controllers;

use App\Models\AccountInfo;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AccountInfoController extends Controller
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
        return Admin::grid(AccountInfo::class, function (Grid $grid) {
            $states = [
                'on'  => ['value' => 1, 'text' => '冻结', 'color' => 'danger'],
                'off' => ['value' => 0, 'text' => '正常', 'color' => 'success'],
            ];
            $grid->UserID('用户编号')->sortable();
            $grid->AccountName('用户名');
            $grid->NickName('用户昵称');
            $grid->FishLevel('等级');
            $grid->FishExp('经验值');
            $grid->Gender('性别')->display(function(){
                return $this->Gender==0?'男':'女';
            });
            $grid->GlobalNum('金币');
            $grid->MedalNum('奖牌数');
            $grid->CurrencyNum('钻石');
            $grid->LastLogonTime('最后登录时间');
            $grid->Production('获得金币');
            $grid->GameTime('游戏时间');
            $grid->TitleID('称号');
            $grid->AchievementPoint('成就点数');
            $grid->OnlineMin('在线分钟');
            $grid->RsgLogTime('注册时间');
            $grid->RsgIP('注册IP');
            $grid->IsOnline('是否在线');
            $grid->IsRobot('机器人');
            $grid->IsFreeze('冻结')->switch($states);
            
            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
            
                // 在这里添加字段过滤器
                $filter->like('AccountName', '用户名');
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
        return Admin::form(AccountInfo::class, function (Form $form) {
            $states = [
                'on'  => ['value' => 1, 'text' => '冻结', 'color' => 'danger'],
                'off' => ['value' => 0, 'text' => '正常', 'color' => 'success'],
            ];
            $form->display('UserID', '用户编号');
            $form->display('AccountName', '用户名');
            $form->text('NickName', '用户昵称');
            $form->number('GlobalNum', '金币');
            $form->number('MedalNum', '奖牌');
            $form->number('CurrencyNum', '钻石');
            $form->switch('IsFreeze', '冻结')->states($states);
        });
    }
}
