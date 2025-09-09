<?php

use Arbor\facades\Route;
use web\controllers\Home;
use web\controllers\ErrorPages;


// ============== ROUTE REGISTRATION ============== //

Route::get('/', Home::class)->name('home');


Route::error(404, [ErrorPages::class, 'notFound']);
