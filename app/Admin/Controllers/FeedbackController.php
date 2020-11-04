<?php

namespace App\Admin\Controllers;

use App\Feedback;
use App\Agenda;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FeedbackController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Feedback';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Feedback);

        $grid->column('id', __('Id'));
        $grid->column('agenda_id', __('Agenda'))->display(function($agendaId) {
            $agenda = Agenda::find($agendaId);
            return "<a href='/admin/agendas/$agendaId'>$agenda->title</a>";
            //return $location->location;
        });
        $grid->column('question', __('Question'));
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
        $show = new Show(Feedback::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('agenda_id', __('Agenda Id'));
        $show->field('question', __('Question'));
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
        $form = new Form(new Feedback);

        $agendas = Agenda::get();
        $arrAgendas = array();
        foreach($agendas as $agenda) {
            $arrAgendas[$agenda->id] = $agenda->title;
        }
        $form->select('agenda_id', __('Agenda'))->options($arrAgendas)->rules('required');

        $form->textarea('question', __('Question'))->rules('required');
        return $form;
    }
}
