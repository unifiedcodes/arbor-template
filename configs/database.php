<?php

return [

    /**
     * Default Pool Settings
     * 
     * Users can override these per connection if needed.
     */
    'maxRetries' => 3,
    'retryDelay' => 1000, // milliseconds

    /**
     * Database Connections
     * 
     * Each key is a connection name. Users can optionally override
     * pool settings per connection.
     */
    'connections' => [

        'main' => [
            'driver'       => 'mysql',
            'host'         => 'localhost',
            'databaseName' => 'cms',
            'username'     => 'root',
            'password'     => '',
        ],

    ],

];
