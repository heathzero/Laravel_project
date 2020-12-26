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


Route::get('/', 'Backend\sanphamController@index')->name('admin.sanpham.index');
Route::get('/admin/sanpham/print', 'Backend\sanphamController@print')->name('admin.sanpham.print');
Route::get('/admin/sanpham/excel', 'Backend\sanphamController@excel')->name('admin.sanpham.excel');
Route::get('/admin/sanpham/pdf', 'Backend\sanphamController@pdf')->name('admin.sanpham.pdf');
Route::get('admin/sanpham', 'Backend\sanphamController@index')->name('admin.sanpham.index');
Route::get('admin/sanpham/create', 'Backend\sanphamController@create')->name('admin.sanpham.create');
Route::post('admin/sanpham/store', 'Backend\sanphamController@store')->name('admin.sanpham.store');
Route::get('admin/sanpham/edit/{id}', 'Backend\sanphamController@edit')->name('admin.sanpham.edit');
Route::put('admin/sanpham/update/{id}', 'Backend\sanphamController@update')->name('admin.sanpham.update');
Route::DELETE('admin/sanpham/destroy/{id}', 'Backend\sanphamController@destroy')->name('admin.sanpham.destroy');
Route::get('admin/loaisanpham', 'Backend\loaisanphamController@index')->name('admin.loaisanpham.index');
Route::get('admin/loaisanpham/create', 'Backend\loaisanphamController@create')->name('admin.loaisanpham.create');
Route::post('admin/loaisanpham/store', 'Backend\loaisanphamController@store')->name('admin.loaisanpham.store');
Route::get('admin/loaisanpham/edit/{id}', 'Backend\loaisanphamController@edit')->name('admin.loaisanpham.edit');
Route::put('admin/loaisanpham/update/{id}', 'Backend\loaisanphamController@update')->name('admin.loaisanpham.update');
Route::get('admin/loaisanpham/edit/{id}', 'Backend\loaisanphamController@edit')->name('admin.loaisanpham.edit');
Route::DELETE('admin/loaisanpham/update/{id}', 'Backend\loaisanphamController@destroy')->name('admin.loaisanpham.destroy');


//route::resource('/admin/sanpham','backend\sanphamController');
//route::resource('/admin/sanpham','backend\sanphamController', ['as' => 'admin']);


Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
