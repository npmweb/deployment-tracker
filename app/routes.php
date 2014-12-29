<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::when('*', 'csrf', ['post', 'put', 'patch', 'delete']);

// include the route partial that corresponds to your endpoint
// if you have a more complex setup, you can replace this
if( endpoint() ) {
    require_once('routes/' . endpoint() . '.php');
}
