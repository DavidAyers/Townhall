<?php

namespace App\Admin\Controllers;

use App\Comment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Attendee;
use App\Social;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Comment);

        $grid->column('id', __('Id'));
        $grid->column('attendee_id', __('Attendee'))->display(function($attendeeId) {
            $attendee = Attendee::find($attendeeId);
            return "<a href='/admin/attendees/$attendeeId'>$attendee->first_name , $attendee->middle_name , $attendee->last_name </a>";
            //return $location->location;
        });

        $grid->column('social_id', __('Social'))->display(function($socialId) {
            return "<a href='/admin/social/posts/$socialId'>$socialId</a>";
            //return $location->location;
        });


        $grid->column('text', __('Text'));
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
        $show = new Show(Comment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('attendee_id', __('Attendee id'));
        $show->field('social_id', __('Social id'));
        $show->field('text', __('Text'));
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
        $form = new Form(new Comment);

        $attendees = Attendee::get();
        $arrAttendees = array();
        foreach($attendees as $attendee) {
            $arrAttendees[$attendee->id] = $attendee->first_name.", ".$attendee->middle_name.", ".$attendee->last_name;
        }
        $form->select('attendee_id', __('Attendee'))->options($arrAttendees)->rules('required');


        $socials = Social::get();
        $arrSocials = array();
        foreach($socials as $social) {
            $arrSocials[$social->id] = $social->id;
        }
        $form->select('social_id', __('Social'))->options($arrSocials)->rules('required');


        $form->textarea('text', __('Text'))->rules('required');

        return $form;
    }
}
