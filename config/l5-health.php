<?php

return [
    /*
     * Application name that would be returned in health check result.
     * If this set to null or false then env('APP_NAME') will be used.
     */
    'application_name' => null,

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
    ],

    /*
     * List of external service dependencies.
     * They will be returned in health check result.
     */
    'service_dependencies' => [

    ]
];