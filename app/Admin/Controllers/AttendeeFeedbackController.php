<?php

namespace App\Admin\Controllers;

use App\AttendeeFeedback;
use App\Feedback;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Attendee;

class AttendeeFeedbackController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\AttendeeFeedback';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AttendeeFeedback);

        $grid->filter(function($filter){
        
            // Add a column filter
            $filter->like('attendee.first_name', 'Attendee First Name');
            $filter->like('attendee.middle_name', 'Attendee Middle Name');
            $filter->like('attendee.last_name', 'Attendee Last Name');
            $filter->like('feedback.question', 'Feedback');
            $filter->like('answer', 'Answer');
        });


        $grid->column('id', __('Id'));
        $grid->column('attendee_id', __('Attendee'))->display(function($attendeeId) {
            $attendee = Attendee::find($attendeeId);
            return "<a href='/admin/attendees/$attendeeId'>$attendee->first_name , $attendee->middle_name , $attendee->last_name </a>";
            //return $location->location;
        });

        $grid->column('feedback_id', __('Feedback'))->display(function($feedbackId) {
            $feedback = Feedback::find($feedbackId);
            return "<a href='/admin/feedback/questions/$feedbackId'>$feedback->question </a>";
            //return $location->location;
        });


        $grid->column('answer', __('Answer'));
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
        $show = new Show(AttendeeFeedback::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('attendee_id', __('Attendee id'));
        $show->field('feedback_id', __('Feedback id'));
        $show->field('answer', __('Answer'));
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
        $form = new Form(new AttendeeFeedback);

        $attendees = Attendee::get();
        $arrAttendees = array();
        foreach($attendees as $attendee) {
            $arrAttendees[$attendee->id] = $attendee->first_name.", ".$attendee->middle_name.", ".$attendee->last_name;
        }
        $form->select('attendee_id', __('Attendee'))->options($arrAttendees)->rules('required');

        $feedbacks = Feedback::get();
        $arrFeedbacks = array();
        foreach($feedbacks as $feedback) {
            $arrFeedbacks[$feedback->id] = $feedback->question;
        }
        $form->select('feedback_id', __('Feedback'))->options($arrFeedbacks)->rules('required');
        $form->number('answer', __('Answer'))->rules('required');

        return $form;
    }
}
