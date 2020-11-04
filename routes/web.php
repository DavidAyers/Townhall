<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
	return view("index");
});

Route::get('/value', 'ValueController@getValueAward');
Route::get('/service', 'ServiceController@getService');
Route::get('/faq', 'FaqController@getFaq');

Route::group(
    ['prefix' => 'api'], function () {

        Route::get('/faq', function() {
            return view("faq");
        });
        Route::get('/service', function() {
            return view("service");
        });
        Route::get('/value', function() {
            return view("value");
        });



        Route::post('/login',               'AttendeeController@login');
        Route::post('/logout',              'AttendeeController@logout');

        Route::get('/attendees',            'AttendeeController@getAttendees');
        Route::get('/attendees/{id}',       'AttendeeController@getAttensdee');

        
        Route::get('/venues/{id}',          'VenueController@getVenue');

        Route::get('/teams',                'TeamController@getTeams');
        Route::get('/teams/{id}',           'TeamController@getTeam');

        Route::get('/socials',               'SocialController@getSocials');
        Route::post('/socials',              'SocialController@postNewSocial');
        Route::get('/socials/{id}',          'SocialController@getSocial');
        Route::post('/socials/like',         'SocialController@postLikeSocial');
        Route::post('/socials/dislike',      'SocialController@postDisLikeSocial');
        Route::get('/socials/{id}/comments', 'SocialController@getComments');
        Route::post('/socials/comments',            'SocialController@postNewComment');
        Route::get('/socials/like/status',          'SocialController@getLikeStatus');

        Route::get('/speakers',                     'SpeakerController@getSpeakers');
        Route::get('/speakers/{id}',                'SpeakerController@getSpeaker');

        Route::get('/notificatons',                             'NotificationController@getNotifications');
        Route::post('/notificatons/{userId}/{notificationId}',  'NotificationController@checkedNotification');

        Route::get('/agendas',            'AgendaController@getAgendas');
        Route::get('/agendas/{id}',       'AgendaController@getAgenda');

        Route::get('/feedbacks/{agendaId}',              'FeedbackController@getFeedbacks');
        Route::post('/answers',                         'FeedbackController@postAnswers');

        Route::post('/registerDevice',              'DeviceController@registerDevice');
});