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

Auth::routes();

Route::get('/{projectId?}', 'HomeController@index')->where('projectId', '[0-9]+');

Route::get('/uploads/{projectId?}', 'UploadsController@index')->where('projectId', '[0-9]+');
Route::get('/uploads/{projectId?}/list', 'UploadsController@list')->where('projectId', '[0-9]+');
Route::post('/uploads/{projectId?}', 'UploadsController@post')->where('projectId', '[0-9]+')->middleware('auth');
Route::post('/uploads/{projectId?}/edit', 'UploadsController@edit')->where('projectId', '[0-9]+')->middleware('auth');
Route::get('/uploads/delete/{fileId}', 'UploadsController@delete')->middleware('auth');

Route::get('/projects', 'ProjectsController@index');
Route::get('/projects/{projectId}', 'ProjectsController@project')->where('projectId', '[0-9]+');
Route::post('/projects/{projectId}', 'ProjectsController@edit')->where('projectId', '[0-9]+');
Route::post('/projects/create', 'ProjectsController@create');