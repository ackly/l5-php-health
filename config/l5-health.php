<?php

return [
    /*
     * Application name that would be returned in health check result
     */
    'application_name' => 'REAL_APP_NAME',

    /*
     * Route for accessing health check info
     */
    'routes' => [
        'health' => '/health'
    ],

    /*
     * Enables check for default database
     */
    'check_db' => true,

    /*
     * Enables check for default memcache
     */
    'check_memcache' => true,

    /*
     * List of additional checks to perform
     */
    'checks' => [
        // 'checkName' => CheckClass::class,
    ],

    /*
     * Argument mapping for health checks
     */
    'run_args' => [
        // 'checkName' => ['arg1' => 'value', 'arg2' => 'value']
    ]
];