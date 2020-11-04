<?php

namespace App\Admin\Controllers;

use App\Agenda;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Location;
use App\Venue;

class AgendaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Agenda';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Agenda);

        $grid->filter(function($filter){
        
            // Add a column filter
            $filter->like('title', 'Title');
            $filter->like('description', 'Description');
            $filter->date('date', 'Date');
            $filter->like('location.location', 'Location');
            $filter->like('venue.name', 'Venue');
        });

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('date', __('Date'));
        $grid->column('start_time', __('Start time'));
        $grid->column('end_time', __('End time'));
        $grid->column('location_id', __('Location'))->display(function($locationId) {
            $location = Location::find($locationId);
            return "<a href='/admin/locations/$locationId'>$location->location</a>";
            //return $location->location;
        });

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
        $show = new Show(Agenda::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('date', __('Date'));
        $show->field('start_time', __('Start time'));
        $show->field('end_time', __('End time'));
        $show->field('location_id', __('Location id'));
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
        $form = new Form(new Agenda);

        $form->text('title', __('Title'))->rules('required|max:200');
        $form->textarea('description', __('Description'))->rules('required');
        $form->date('date', __('Date'))->rules('required');
        $form->time('start_time', __('Start time'))->rules('required');

        $form->time('end_time', __('End time'))->rules('required');
        

        $venues = Venue::get();
        $arrVenues = array();
        foreach($venues as $venue) {
            $arrVenues[$venue->id] = $venue->name;
        }
        $form->select('venue_id', __('Venue'))->options($arrVenues)->rules('required')->load('location_id','/admin/api/location');

        $form->select('location_id', __('Location'))->rules('required');

        return $form;
    }
}
