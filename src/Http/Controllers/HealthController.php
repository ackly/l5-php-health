<?php

namespace Ackly\L5Health\Http\Controllers;

use \Illuminate\Routing\Controller;
use \Response;


/**
 * Class HealthController
 */
class HealthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function index()
    {
        $healthCheck = new \Ackly\Health\HealthCheck(config('l5-health.application_name', env('APP_NAME')));

        $checks = config('l5-health.checks', []);
        $runArgs = config('l5-health.run_args', []);

        if (config('l5-health.check_db')) {
            $checks['db'] = \Ackly\Health\Check\DB::class;

            $runArgs['db'] = [
                'pdo' => \DB::connection()->getPdo()
            ];
        }

        if (config('l5-health.check_memcache')) {
            $checks['memcache'] = \Ackly\Health\Check\Memcache::class;

            $runArgs['memcache'] = [
                'class' => env('CACHE_DRIVER'),
                'host' => env('MEMCACHED_HOST'),
                'port' => env('MEMCACHED_PORT')
            ];
        }

        foreach ($checks as $name => $check) {
            $healthCheck->addCheck($name, $check);
        }

        $content = $healthCheck->run($runArgs);

        $status = $healthCheck->result['status'] == 'error' ? 500 : 200;

        return Response::make($content, $status, [
            'Content-Type' => 'application/json'
        ]);
    }
}