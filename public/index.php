<?php

/**
 * Front Controller - Main application entry point
 * 
 * This file serves as the front controller for the web application,
 * handling all HTTP requests and bootstrapping the application.
 * 
 * @package Arbor
 */

use Arbor\bootstrap\App;

// Load Composer autoloader
require_once '../vendor/autoload.php';


// Bootstrap and configure the application
$app = (new App())

    // Set global configuration directory
    ->withConfig('../configs/')

    // Set environment mode
    ->onEnvironment('development')

    // Load web-specific config
    ->useAppConfig('web', 'web/configs/app.php')

    // Initialize the application
    ->boot();


// Handle incoming HTTP request and generate response
$response = $app->handleHTTP();

// Send response to client
$response->send();
