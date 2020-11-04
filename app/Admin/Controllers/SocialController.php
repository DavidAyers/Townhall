<?php

namespace App\Admin\Controllers;

use App\Attendee;
use App\Social;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SocialController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Social';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Social);

        $grid->column('id', __('Id'));
        $grid->column('image', __('Image'))->display(function($image) {
            return "<img src='/uploads/$image' width='100px'>";
        });
        $grid->column('text', __('Text'));
        $grid->column('likes', __('Likes'));

        $grid->column('attendee_id', __('Attendee'))->display(function($attendeeId) {
            $attendee = Attendee::find($attendeeId);
            return "<a href='/admin/attendees/$attendeeId'>$attendee->first_name , $attendee->middle_name , $attendee->last_name </a>";
            //return $location->location;
        });

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
        $show = new Show(Social::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'))->display(function($image) {
            return "<img src='/uploads/$image' width='100px'";
        });
        $show->field('text', __('Text'));
        $show->field('likes', __('Likes'));
        $show->field('attendee_id', __('Attendee id'));
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
        $form = new Form(new Social);

        $form->image('image', __('*Image'))->default('/uploads/avatar/social/default.png')->move('/uploads/avatar/social' , $this->quickRandom().time().'.png')->rules('required');
        $form->textarea('text', __('Text'))->rules('required');
        $form->number('likes', __('Likes'))->default(0)->rules('required');

        $attendees = Attendee::get();
        $arrAttendees = array();
        foreach($attendees as $attendee) {
            $arrAttendees[$attendee->id] = $attendee->first_name.", ".$attendee->middle_name.", ".$attendee->last_name;
        }
        $form->select('attendee_id', __('Attendee'))->options($arrAttendees)->rules('required');

        return $form;
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
