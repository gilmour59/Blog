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
Route::get('/test', function () {
    //dd(App\Category::find(1)->posts());
    return App\Category::find(1)->posts;
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/post', 'PostController@index')->name('post');
    Route::get('/post/create', 'PostController@create')->name('post.create');
    Route::post('/post/store', 'PostController@store')->name('post.store');
    Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
    Route::put('/post/update/{id}', 'PostController@update')->name('post.update');
    Route::delete('/post/delete/{id}', 'PostController@destroy')->name('post.delete');
    Route::get('/post/trash', 'PostController@trash')->name('post.trash');
    Route::get('post/restore/{id}', 'PostController@restore')->name('post.restore');
    Route::get('post/kill/{id}', 'PostController@kill')->name('post.kill');

    Route::get('/category', 'CategoryController@index')->name('category');
    Route::get('/category/create', 'CategoryController@create')->name('category.create');
    Route::post('/category/store', 'CategoryController@store')->name('category.store');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::put('/category/update/{id}', 'CategoryController@update')->name('category.update');
    Route::delete('/category/delete/{id}', 'CategoryController@destroy')->name('category.delete');

    Route::get('/tag', 'TagController@index')->name('tag');
    Route::get('/tag/create', 'TagController@create')->name('tag.create');
    Route::post('/tag/store', 'TagController@store')->name('tag.store');
    Route::get('/tag/edit/{id}', 'TagController@edit')->name('tag.edit');
    Route::put('/tag/update/{id}', 'TagController@update')->name('tag.update');
    Route::delete('/tag/delete/{id}', 'TagController@destroy')->name('tag.delete');
});