<?php

use Illuminate\Support\Facades\Route;

Route::match( [ 'GET', 'POST' ], '/', 'HomeController@init' )->name( 'home' );
