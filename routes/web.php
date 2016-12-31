<?php



Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/webhook/encoding','EncodingWebhookController@handle') ;

Route::get('videos/{video}','VideoController@show');

Route::post('/videos/{video}/views','VideoViewController@create');
Route::get('/serach','SearchController@index');

Route::get('/videos/{video}/comment', 'VideoCommentController@index');
Route::get('/videos/{video}/votes','VideoVoteController@show');


Route::group(['middleware' => ['auth']],  function() {

	Route::get('/upload/','VideoUploadController@index');
	Route::post('/upload/','VideoUploadController@store');

	Route::get('/videos','VideoController@index');
	Route::get('/videos/{video}/edit','VideoController@edit');
	Route::delete('/videos/{video}','VideoController@delete');
	Route::post('/videos','VideoController@store');

	Route::put('/videos/{video}','VideoController@update');

	Route::get('/channel/{channel}/edit','ChannelSettingsController@edit');
	Route::put('/channel/{channel}/edit','ChannelSettingsController@update');


	Route::get('/channel/{channel}','ChannelSettingsController@edit');

});

