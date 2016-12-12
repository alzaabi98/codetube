<?php



Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/webhook/encoding','EncodingWebhookController@handle') ;

Route::group(['middleware' => ['auth']],  function() {

	Route::get('/upload/','VideoUploadController@index');
	Route::post('/upload/','VideoUploadController@store');

	Route::get('/videos','VideoController@index');
	Route::post('/videos','VideoController@store');
	Route::put('/videos/{video}','VideoController@update');

	Route::get('/channel/{channel}/edit','ChannelSettingsController@edit');
	Route::put('/channel/{channel}/edit','ChannelSettingsController@update');

});

