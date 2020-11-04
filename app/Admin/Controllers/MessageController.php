<?php

namespace App\Admin\Controllers;

use App\Message;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Venue;
use Illuminate\Support\Arr;
use Hash;
use App\Device;

class MessageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Message';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Message);

        $grid->column('id', __('Id'));
        $grid->column('head', __('Head'));
        $grid->column('content', __('Content'));

        $arrNames = ['welcome' => 'Welcome Message' , 'notification_to_venue' => 'Notification to Venue' , 'notification_to_all' => 'Notification to All'];
        $grid->column('type', __('Type'))->display(function($type) use ($arrNames) {
            return $arrNames[$type];
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
        $show = new Show(Message::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('head', __('Head'));
        $show->field('content', __('Content'));
        
        $arrNames = ['welcome' => 'Welcome Message' , 'notification_to_venue' => 'Notification to Venue' , 'notification_to_all' => 'Notification to All'];
        $show->field('type', __('Type'))->as(function($type) use ($arrNames) {
            return $arrNames[$type];
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
        $form = new Form(new Message);

        $form->text('head', __('Head'))->rules('required');
        $form->textarea('content', __('Content'))->rules('required');

        $arrNames = ['welcome' => 'Welcome Message' , 'notification_to_venue' => 'Notification to Venue' , 'notification_to_all' => 'Notification to All'];
        $form->select('type' , __('Type'))->options($arrNames)->rules('required');

        $venues = Venue::get();
        $arrVenues = array();
        foreach($venues as $venue) {
            $arrVenues[$venue->id] = $venue->name;
        }
        $form->select('venue_id', __('Venue'))->options($arrVenues)->rules('required');

        $form->saving(function ($form) {
            $type = $form->type;

            $title = $form->head;
            $message = $form->content;

            if ($type === "notification_to_venue") {
                $venueId = $form->venue_id;
                $this->sendNotification($venueId, $title, $message);
            } else if($type === "notification_to_all") {
                $this->sendNotification(0, $title, $message);
            }

        });

        return $form;
    }

    public function sendNotification($venueId = 0 , $title, $message) {
        if($venueId == 0) {
            $content = array(
                "en" => $message
                );
        
            $fields = array(
                'app_id' => "40ca7715-a7ad-48c4-ba10-2852f0c407d9",
                'included_segments' => array('All'),
                'data' => array("foo" => "bar"),
                'large_icon' =>"ic_launcher_round.png",
                'contents' => $content
            );
        
            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                    'Authorization: Basic OWM2MzUxNTYtMmQxMi00Y2Y0LWIyODctODJhZGUyZGE5NjMz'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
            $response = curl_exec($ch);
            curl_close($ch);
            
            $return["allresponses"] = $response;
            $return = json_encode( $return);
            print("\n\nJSON received:\n");
            print($return);
            print("\n");
        } else {

            $devices = Device::where("venue_id", $venueId)->get();
           
            $deviceTokenArray = Array();


            foreach($devices as $device) {
                array_push($deviceTokenArray, $device->device_token);
            }

            $content = array(
                "en" => $message
                );
        
            $fields = array(
                'app_id' => "40ca7715-a7ad-48c4-ba10-2852f0c407d9",
                'included_segments' => array('All'),
                'data' => array("foo" => "bar"),
                'large_icon' =>"ic_launcher_round.png",
                'contents' => $content ,
                'send_to' => "identifiers",
                'identifiers' => $deviceTokenArray
            );
        
            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                    'Authorization: Basic OWM2MzUxNTYtMmQxMi00Y2Y0LWIyODctODJhZGUyZGE5NjMz'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
            $response = curl_exec($ch);
            curl_close($ch);
            
               
            $return["allresponses"] = $response;
            $return = json_encode( $return);
            print("\n\nJSON received:\n");
            print($return);
            print("\n");
        }
    }
}
