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

Route::get('/','UserController@index');
Route::post('users','usercontroller@store')->name('users.strore');
Route::delete('users/{user}','usercontroller@destroy')->name('users.destroy');

Route::get('/DocumentType','DocumentTypeController@index')->name('documentType.index');
Route::post('DocumentsTypes', 'DocumentTypeController@store')->name('documentType.store');
Route::get('DocumentsTypes/edit/{id}', 'DocumentTypeController@edit')->name('documentType.edit');
Route::post('DocumentsTypes/update', 'DocumentTypeController@update')->name('documentType.update');
Route::delete('DocumentsTypes/destroy/{id}', 'DocumentTypeController@destroy')->name('documentType.destroy');
Route::get('DocumentsTypes/read', 'DocumentTypeController@read')->name('documentType.read');