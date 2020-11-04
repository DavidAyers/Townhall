<?php

namespace App\Admin\Controllers;

use App\Device;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Attendee;
use App\Venue;

class DeviceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Device';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Device);

        $grid->column('id', __('Id'));

        $grid->column('attendee_id', __('Attendee'))->display(function($attendeeId) {
            $attendee = Attendee::find($attendeeId);
            return "<a href='/admin/attendees/$attendeeId'>$attendee->first_name , $attendee->middle_name , $attendee->last_name </a>";
            //return $location->location;
        });

        $grid->column('venue_id', __('Venue'))->display(function($venueId) {
            $venue = Venue::find($venueId);
            return "<a href='/admin/venues/$venueId'>$venue->name</a>";
            //return $location->location;
        });

        

        $grid->column('device_token', __('Device token'));
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
        $show = new Show(Device::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('attendee_id', __('Attendee id'));
        $show->field('device_token', __('Device token'));
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
        $form = new Form(new Device);

       $attendees = Attendee::get();
        $arrAttendees = array();
        foreach($attendees as $attendee) {
            $arrAttendees[$attendee->id] = $attendee->first_name.", ".$attendee->middle_name.", ".$attendee->last_name;
        }
        $form->select('attendee_id', __('Attendee'))->options($arrAttendees)->rules('required');

        $venues = Venue::get();
        $arrVenues = array();
        foreach($venues as $venue) {
            $arrVenues[$venue->id] = $venue->name;
        }
        $form->select('venue_id', __('Venue'))->options($arrVenues)->rules('required');

        $form->textarea('device_token', __('Device token'))->rules('required');

        return $form;
    }
}
