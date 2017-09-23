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

Route::get('/', function () {
    //return view('welcome');
	return redirect("/meeting/list");
});


//bigbluebutton testing root
 Route::get('/meetings','BigBlueButtonController@getMeetings');
 Route::get('/meeting/add','BigBlueButtonController@addMeeting');
 Route::get('/meeting/list','BigBlueButtonController@listMeeting');
 Route::post('/meeting/create','BigBlueButtonController@createMeeting');
 Route::get('/meeting/join/{name}/{password}/{meetingID}','BigBlueButtonController@joinMeeting');
 Route::get('/meeting/info/{password}/{meetingID}','BigBlueButtonController@getMeetingInfo');
 Route::get('/meeting/close/{password}/{meetingID}','BigBlueButtonController@closeMeeting');
 Route::get('/meeting/recordings','BigBlueButtonController@getRecordings');
 Route::get('/meeting/recording/delete/{recordId}','BigBlueButtonController@deleteRecordings');
 Route::get('/meeting/running','BigBlueButtonController@isMeetingRunning');
