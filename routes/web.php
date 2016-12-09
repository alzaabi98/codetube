<?php



Route::get('/', function () {
    return view('welcome');
});


Route::post('/webhook/encoding','EncodingWebhookController@handle') ;
Auth::routes();

Route::get('/home', 'HomeController@index','encodingWebhookController@handle');


Route::group(['middleware' => ['auth']],  function() {

	Route::get('/upload/','VideoUploadController@index');
	Route::post('/upload/','VideoUploadController@store');

	Route::post('/videos','VideoController@store');
	Route::put('/videos/{video}','VideoController@update');

	Route::get('/channel/{channel}/edit','ChannelSettingsController@edit');
	Route::put('/channel/{channel}/edit','ChannelSettingsController@update');

});

