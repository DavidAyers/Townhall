<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('/members', TeamController::class);
    $router->resource('/attendees', AttendeeController::class);
    $router->resource('/venues', VenueController::class);
    $router->resource('/agendas', AgendaController::class);
    $router->resource('/locations', LocationController::class);
    $router->resource('/speakers', SpeakerController::class);
    $router->resource('/messages', MessageController::class);

    $router->resource('/social/posts', SocialController::class);
    $router->resource('/social/comments', CommentController::class);

    $router->resource('/feedback/questions', FeedbackController::class);
    $router->resource('/feedback/answers', AttendeeFeedbackController::class);
    $router->resource('/devices', DeviceController::class);

    $router->get('/import/excel/attendees', 'ImportController@importView');
    $router->post('/import', 'ImportController@import');


    $router->get('/api/location', 'ApiController@getLocationIdByVenue');
});
