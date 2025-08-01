<?php

/**
 * 
 * Application Configuration
 * 
 * ------------------------------------------------------------------------
 * 
 * This configuration array defines essential settings and paths
 * that control the behavior and structure of the application.
 * It establishes directory mappings, URL handling, resource paths,
 * and environment options.
 * 
 * Note: Constants like BASE_URI, ROOT_DIR, and HTTP_PROTOCOL
 * are expected to be defined globally in the application's bootstrap process.
 * 
 */

return [
    /**
     * Application name or title, typically displayed in browser tabs or headers
     */
    'title' => 'Website',

    /**
     * Absolute path to the root directory of the application
     */
    'root_dir' => ROOT_DIR,

    /**
     * Global base URI of the application, used for constructing URLs
     */
    'global_base_uri' => BASE_URI,

    /**
     * Base URI specific to this app instance, used for routing and URL generation
     */
    'base_uri' => BASE_URI,

    /**
     * Protocol used for absolute URLs (e.g., http:// or https://)
     */
    'http_protocol' => HTTP_PROTOCOL,

    /**
     * Complete URL to shared static resources such as images, stylesheets, and scripts
     */
    'statics_url' => HTTP_PROTOCOL . BASE_URI . 'static/',

    /**
     * Complete URL to user-uploaded files accessible by the application
     */
    'uploads_url' => HTTP_PROTOCOL . BASE_URI . 'uploads/',

    /**
     * Complete URL to app-specific assets such as stylesheets, scripts, and UI components
     */
    'assets_url' => HTTP_PROTOCOL . BASE_URI . 'web/assets/',

    'assets_dir' => ROOT_DIR . '/web/assets/',

    /**
     * Optional URI prefix for namespacing routes within the app
     */
    'uri_prefix' => '',

    /**
     * Filesystem path to this app's configuration files
     */
    'config_dir' => ROOT_DIR . '/web/configs/',

    /**
     * Filesystem path to this app's route definitions
     */
    'routes_dir' => ROOT_DIR . '/web/routes/',

    /**
     * Filesystem path where user-uploaded files are stored
     */
    'uploads_dir' => ROOT_DIR . '/uploads/',

    /**
     * Toggle for enabling debug mode
     * True enables detailed error reporting and debugging tools
     * False is recommended for production environments
     */
    'isDebug' => defined('IS_DEBUG') ? constant('IS_DEBUG') : false,

    /**
     * Filesystem path to view templates for this app
     */
    'views_dir' => ROOT_DIR . '/web/views/',

    /**
     * Filesystem path to static files served directly by the web server
     */
    'statics_dir' => ROOT_DIR . '/static/',
];
