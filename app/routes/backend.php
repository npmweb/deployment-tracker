<?php

Route::group(['namespace' => 'NpmWeb\DeploymentTracker\Controllers\Backend'], function() {
    Route::get('monitor', 'MonitorController@index');

    Route::get('login', 'LoginsController@create');
    Route::resource('logins', 'LoginsController', ['only'=>['create','store','destroy']]);

    Route::group(['before'=>['auth']], function() {
        Route::get('/', 'OrganizationsController@index');
        Route::resource('organizations', 'OrganizationsController');

    });
});

Route::resource('monitor/health', 'NpmWeb\LaravelHealthCheck\Controllers\HealthCheckController',
    ['only' => ['index','show']]);