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
     * List of checks to perform
     */
    'checks' => [
        'db' => Ackly\Health\Check\DB::class,
        'memcache' => Ackly\Health\Check\Memcache::class,
        // 'checkName' => CheckClass::class,
    ],

    /*
     * Argument mapping for health checks
     */
    'run_args' => [
        'db' => function() {return ['pdo' => \DB::connection()->getPdo()];},
        'memcache' => [
            'class' => env('CACHE_DRIVER'),
            'host' => env('MEMCACHED_HOST'),
            'port' => env('MEMCACHED_PORT')
        ],
        // 'checkName' => ['arg1' => 'value', 'arg2' => 'value']
    ],

    /*
     * List of external service dependencies.
     * They will be returned in health check result.
     */
    'service_dependencies' => [

    ]
];