<?php


Route::group(
    ['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function()
    {

        Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function(){
            Route::get('/index','DashboardController@index' )->name('index');

            //user routes
            Route::resource('users', 'UserController')->except(['show']);
            Route::resource('categories', 'CategoryController')->except(['show']);
            Route::resource('products', 'ProductController')->except(['show']);

        });

    });

