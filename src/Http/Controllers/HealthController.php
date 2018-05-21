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
        $appName = config('l5-health.application_name');
        $healthCheck = new \Ackly\Health\HealthCheck($appName ?: env('APP_NAME'));

        $checks = config('l5-health.checks', []);
        $runArgs = config('l5-health.run_args', []);

        $healthCheck->addDependency(config('l5-health.service_dependencies', []));

        foreach ($checks as $name => $check) {
            $healthCheck->addCheck($name, $check);
        }

        foreach ($runArgs as $name => &$value) {
            if (is_callable($value)) {
                $runArgs[$name] = $value();
            }

            if (isset($value['connection'])) {
                $value['pdo'] = \DB::connection($value['connection'])->getPdo();
                unset($value['connection']);
            }
        }

        $content = $healthCheck->run($runArgs);

        $status = $healthCheck->result['status'] == 'error' ? 500 : 200;

        return Response::make($content, $status, [
            'Content-Type' => 'application/json'
        ]);
    }
}