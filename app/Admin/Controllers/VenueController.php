<?php

namespace App\Admin\Controllers;

use App\Venue;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VenueController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Venue';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Venue);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('detail_hotel', __('Detail hotel'));
        $grid->column('things_area', __('Things area'));
        $grid->column('transportation', __('Transportation'));
        $grid->column('driving', __('Driving'));
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
        $show = new Show(Venue::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('detail_hotel', __('Detail hotel'));
        $show->field('things_area', __('Things area'));
        $show->field('transportation', __('Transportation'));
        $show->field('driving', __('Driving'));
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
        $form = new Form(new Venue);

        $form->text('name', __('Name'))->rules('required');
        $form->textarea('detail_hotel', __('Detail hotel'))->rules('required');
        $form->textarea('things_area', __('Things area'))->rules('required');
        $form->textarea('transportation', __('Transportation'))->rules('required');
        $form->textarea('driving', __('Driving'))->rules('required');

        return $form;
    }
}
