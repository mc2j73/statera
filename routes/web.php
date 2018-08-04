<?php

Auth::routes();

Route::get('/', function(){
	return redirect()->route('home');
})->name('index');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
	Route::group([
		'prefix' => 'character', 
		'as' => 'character.'
	], function(){
		Route::get('/', function(){return "main character";});
		Route::post('/store', 'CharacterController@store')->name('store');
		Route::get('/create', 'CharacterController@create')->name('create');
	});
});