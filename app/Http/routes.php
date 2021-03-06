<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/info', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');
//
//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);


// Public Server Status Beacon
Route::get('beacon',
  function() {

    $serverConfig = config('landrive');

    return response()->json(['Status' => 1 , 'Code' => 200 , 'Message' => 'Landrive Server found!' ,  'Server' => 'Landrive' , 'Name' => $serverConfig['servername'] ]);

 });

// Get LanDriveAccess Route
Route::post('api/token/new','Landrive\Token\LanDriveTokenController@getToken');

// This route is accessible only to Authenticated Requests
Route::group(['middleware' => 'ValidateLanDriveAPIRequest'], function()
{

  // Resourceful drive Route
  Route::resource('api/drive', 'Landrive\Driveapi\DriveController');

  // Token Routes
  Route::post('api/token/revoke','Landrive\Token\LanDriveTokenController@revokeToken');


  // Remote Music Player routes
  Route::get('api/remotemusicplayer','Landrive\RemoteMusicPlayer\LandriveRemoteMusicPlayerController@index');

  Route::post('api/remotemusicplayer','Landrive\RemoteMusicPlayer\LandriveRemoteMusicPlayerController@post');

  Route::post('api/remotemusicplayer/clear','Landrive\RemoteMusicPlayer\LandriveRemoteMusicPlayerController@clear');

  Route::post('api/remotemusicplayer/clearall','Landrive\RemoteMusicPlayer\LandriveRemoteMusicPlayerController@clearAll');


  // Server Config
  Route::get('server/config' , 'Landrive\Server\LanDriveServerConfigController@index');

});


// Mobile i.e
//Single Page Application for browsing Landrive

  //Main
  Route::get('/','LanDriveSPAController@index');

  // Partials
  Route::get('mobile/angular/partials/home' , 'LanDriveSPAController@getPartialHome');

  Route::get('mobile/angular/partials/browse' , 'LanDriveSPAController@getPartialBrowse');

  Route::get('mobile/angular/partials/view' , 'LanDriveSPAController@getPartialView');

  Route::get('mobile/angular/partials/add' , 'LanDriveSPAController@getPartialAdd');

  Route::get('mobile/angular/partials/remote' , 'LanDriveSPAController@getPartialRemote');

  Route::get('mobile/angular/partials/login' , 'LanDriveSPAController@getPartialLogin');

  Route::get('mobile/angular/partials/logout' , 'LanDriveSPAController@getPartialLogout');