<?php

use Arbor\facades\Route;
use web\controllers\Home;


// ============== ROUTE REGISTRATION ============== //

Route::get('/', Home::class)->name('home');
