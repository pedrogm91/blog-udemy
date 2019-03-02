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

Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('about', 'PagesController@about')->name('pages.about');
Route::get('archive', 'PagesController@archive')->name('pages.archive');
Route::get('contact', 'PagesController@contact')->name('pages.contact');

Route::get('/blog/{post}', 'PostsController@show')->name('posts.show');
Route::get('categorias/{category}',  'CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function(){
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('posts', 'PostsController@index')->name('admin.posts.index');
    Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
    Route::post('posts/', 'PostsController@store')->name('admin.posts.store');
    Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
    Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
    Route::delete('posts/{post}', 'PostsController@destroy')->name('admin.posts.destroy');
    
    Route::post('posts/{post}/photos', 'PhotoController@store')->name('admin.posts.photos.store');
    Route::delete('posts/{photo}', 'PhotoController@destroy')->name('admin.photo.destroy');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');