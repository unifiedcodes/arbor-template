<?php

use Arbor\facades\Route;
use App\web\controllers\Home;
use App\web\controllers\ErrorPages;


// ============== ROUTE REGISTRATION ============== //

Route::get('/', Home::class)->name('home');


Route::error(404, [ErrorPages::class, 'notFound']);
