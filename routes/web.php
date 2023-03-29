<?php

use App\Rol;
use Illuminate\Support\Facades\Route;

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

Route::get('/','UserController@index')->name('users.index');
Route::post('users','UserController@store')->name('users.strore');
Route::get('users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::post('users/update', 'UserController@update')->name('users.update');
Route::delete('users/destroy/{id}', 'UserController@destroy')->name('users.destroy');
Route::get('users/read', 'UserController@read')->name('users.read');

Route::get('/DocumentType','DocumentTypeController@index')->name('documentType.index');
Route::post('DocumentsTypes', 'DocumentTypeController@store')->name('documentType.store');
Route::get('DocumentsTypes/edit/{id}', 'DocumentTypeController@edit')->name('documentType.edit');
Route::post('DocumentsTypes/update', 'DocumentTypeController@update')->name('documentType.update');
Route::delete('DocumentsTypes/destroy/{id}', 'DocumentTypeController@destroy')->name('documentType.destroy');
Route::get('DocumentsTypes/read', 'DocumentTypeController@read')->name('documentType.read');

Route::get('/Roles','RolesController@index')->name('rols.index');
Route::post('Roles','RolesController@store')->name('rols.store');
Route::get('Roles/edit/{id}', 'RolesController@edit')->name('rols.edit');
Route::post('Roles/update', 'RolesController@update')->name('rols.update');
Route::delete('Roles/destroy/{id}', 'RolesController@destroy')->name('rols.destroy');
Route::get('Roles/read', 'RolesController@read')->name('rols.read');