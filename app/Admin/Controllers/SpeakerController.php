<?php

namespace App\Admin\Controllers;

use App\Speaker;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Venue;

class SpeakerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Speaker';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Speaker);

        $grid->column('id', __('Id'));
        $grid->column('bio', __('Bio'));
        $grid->column('description', __('Description'));
        $grid->column('image', __('Image'))->display(function($image) {
            return "<img src='/uploads/$image' width='100px'>";
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
        $show = new Show(Speaker::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('bio', __('Bio'));
        $show->field('description', __('Description'));
        $show->field('image', __('Image'))->display(function($image) {
            return "<img src='/uploads/$image' width='100px'";
        });
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
        $form = new Form(new Speaker);

        $form->text('bio', __('Bio'))->rules('required');
        $form->textarea('description', __('Description'))->rules('required');
        $form->image('image', __('*Image'))->default('/uploads/avatar/speaker/default.png')->move('/uploads/avatar/speaker' , $this->quickRandom().time().'.png')->rules('required');
        $venues = Venue::get();
        $arrVenues = array();
        foreach($venues as $venue) {
            $arrVenues[$venue->id] = $venue->name;
        }
        $form->select('venue_id', __('Venue'))->options($arrVenues)->rules('required');

        return $form;
    }
    
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
