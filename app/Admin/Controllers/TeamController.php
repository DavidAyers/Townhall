<?php

namespace App\Admin\Controllers;

use App\Team;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TeamController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Team';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Team);

        $grid->column('id', __('Id'));
        $grid->column('bio', __('Bio'));
        $grid->column('part_of_company', __('Part of company'));
        $grid->column('image', __('Image'))->display(function($image) {
            return "<img src='/uploads/$image' width='100px'>";
        });
        $grid->column('bullet1', __('Bullet1'));
        $grid->column('bullet2', __('Bullet2'));
        $grid->column('bullet3', __('Bullet3'));
        $grid->column('bullet4', __('Bullet4'));
        $grid->column('bullet5', __('Bullet5'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Team::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('bio', __('Bio'));
        $show->field('part_of_company', __('Part of company'));
        $show->field('image', __('Image'))->display(function($image) {
            return "<img src='/uploads/$image' width='100px'>";
        });
        $show->field('bullet1', __('Bullet1'));
        $show->field('bullet2', __('Bullet2'));
        $show->field('bullet3', __('Bullet3'));
        $show->field('bullet4', __('Bullet4'));
        $show->field('bullet5', __('Bullet5'));
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
        $form = new Form(new Team);

        $form->text('bio', __('Bio'))->rules('required');
        $form->text('part_of_company', __('Part of company'))->rules('required');
        $form->image('image', __('*Image'))->default('/uploads/avatar/team/default.png')->move('/uploads/avatar/team' , $this->quickRandom().time().'.png')->rules('required');
        $form->textarea('bullet1', __('Bullet1'))->rules('required');
        $form->textarea('bullet2', __('Bullet2'))->rules('required');
        $form->textarea('bullet3', __('Bullet3'))->rules('required');
        $form->textarea('bullet4', __('Bullet4'))->rules('required');
        $form->textarea('bullet5', __('Bullet5'))->rules('required');

        return $form;
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
