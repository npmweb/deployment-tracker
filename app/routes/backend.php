<?php

Route::group(['namespace' => 'NpmWeb\DeploymentTracker\Controllers\Backend'], function() {
    Route::get('monitor', 'MonitorController@index');

    Route::get('login', 'LoginsController@create');
    Route::resource('logins', 'LoginsController', ['only'=>['create','store','destroy']]);


    Route::group(['before'=>['auth']], function() {
        Route::get('/', 'ServersController@index');
        Route::resource('applications', 'ApplicationsController');
        Route::resource('applications.endpoints', 'EndpointsController');
        Route::resource('applications.endpoints.environment_endpoints', 'EnvironmentEndpointsController');

        Route::resource('environments', 'EnvironmentsController');

        Route::resource('servers', 'ServersController');
        Route::resource('servers.ip_addresses', 'IpAddressesController');
        Route::resource('servers.ip_addresses.domains', 'DomainsController');
    });
});

Route::resource('monitor/health', 'NpmWeb\LaravelHealthCheck\Controllers\HealthCheckController',
    ['only' => ['index','show']]);