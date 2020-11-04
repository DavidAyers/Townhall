<?php

namespace App\Admin\Controllers;

use App\Attendee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Venue;
use Hash;

class AttendeeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Attendee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Attendee);

        $grid->column('id', __('Id'));
        $grid->column('image', __('Image'))->display(function($image) {
            return "<img src='/uploads/$image' width='100px'>";
        });
        $grid->column('primary_email', __('Primary email'));
        $grid->column('secondary_email', __('Secondary email'));
        $grid->column('first_name', __('First name'));
        $grid->column('middle_name', __('Middle name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('department', __('Department'));
        $grid->column('job', __('Job'));
        $grid->column('manager_name', __('Manager name'));
        $grid->column('manager_title', __('Manager title'));
        $grid->column('office_location', __('Office location'));
        $grid->column('primary_number', __('Primary number'));
        $grid->column('cell_number', __('Cell number'));
        $grid->column('emergency_contract_name', __('Emergency contract name'));
        $grid->column('emergency_contract_phone', __('Emergency contract phone'));
        $grid->column('air_travel_assistance', __('Air travel assistance'));
        $grid->column('hotel_room', __('Hotel room'));
        $grid->column('dietary_concerns', __('Dietary concerns'));
        $grid->column('password', __('Password'));
        $grid->column('venue_id', __('Venue'))->display(function($venueId) {
            $venue = Venue::find($venueId);
            return "<a href='/admin/venues/$venueId'>$venue->name</a>";
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
        $show = new Show(Attendee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'))->display(function($image) {
            return "<img src='/uploads/$image' width='100px'";
        });
        $show->field('primary_email', __('Primary email'));
        $show->field('secondary_email', __('Secondary email'));
        $show->field('first_name', __('First name'));
        $show->field('middle_name', __('Middle name'));
        $show->field('last_name', __('Last name'));
        $show->field('department', __('Department'));
        $show->field('job', __('Job'));
        $show->field('manager_name', __('Manager name'));
        $show->field('manager_title', __('Manager title'));
        $show->field('office_location', __('Office location'));
        $show->field('primary_number', __('Primary number'));
        $show->field('cell_number', __('Cell number'));
        $show->field('emergency_contract_name', __('Emergency contract name'));
        $show->field('emergency_contract_phone', __('Emergency contract phone'));
        $show->field('air_travel_assistance', __('Air travel assistance'));
        $show->field('hotel_room', __('Hotel room'));
        $show->field('dietary_concerns', __('Dietary concerns'));
        $show->field('password', __('Password'));
        $show->field('venue_id', __('Venue id'));
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
        $form = new Form(new Attendee);

        $form->image('image', __('*Image'))->move('/uploads/avatar/attendee' , $this->quickRandom().time().'.png')->creationRules(['required'])->updateRules(['required']);
        $form->text('primary_email', __('Primary email'))->creationRules(['required', "unique:table_attendees"])->updateRules(['required', "unique:table_attendees,primary_email,{{id}}"]);
        $form->text('secondary_email', __('Secondary email'));
        $form->text('first_name', __('First name'))->rules('required');
        $form->text('middle_name', __('Middle name'));
        $form->text('last_name', __('Last name'))->rules('required');
        $form->text('department', __('Department'));
        $form->text('job', __('Job'));
        $form->text('manager_name', __('Manager name'));
        $form->text('manager_title', __('Manager title'));
        $form->text('office_location', __('Office location'));
        $form->text('primary_number', __('Primary number'));
        $form->text('cell_number', __('Cell number'));
        $form->text('emergency_contract_name', __('Emergency contact name'));
        $form->text('emergency_contract_phone', __('Emergency contact phone'));
        $form->text('air_travel_assistance', __('Air travel assistance'))->default('Yes');
        $form->text('hotel_room', __('Hotel room'))->default('Yes');
        $form->text('dietary_concerns', __('Dietary concerns'));
        $form->password('password', __('Password'))->rules('required|min:8');
        $venues = Venue::get();
        $arrVenues = array();
        foreach($venues as $venue) {
            $arrVenues[$venue->id] = $venue->name;
        }
        $form->select('venue_id', __('Venue'))->options($arrVenues)->rules('required');

        $form->saving(function ($form) {
            $form->input('password', Hash::make($form->password));
        });

        return $form;
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
