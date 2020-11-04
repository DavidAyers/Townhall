<?php

namespace App\Admin\Controllers;

use App\Location;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Venue;

class LocationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Location';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Location);

        $grid->column('id', __('Id'));
        $grid->column('location', __('Location'));

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
        $show = new Show(Location::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('location', __('Location'));
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
        $form = new Form(new Location);

        $form->text('location', __('Location'))->rules('required');

        $venues = Venue::get();
        $arrVenues = array();
        foreach($venues as $venue) {
            $arrVenues[$venue->id] = $venue->name;
        }
        $form->select('venue_id', __('Venue'))->options($arrVenues)->rules('required');

        return $form;
    }
}
