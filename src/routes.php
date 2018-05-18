<?php

$router->get(config('l5-health.routes.health'), [
    'as' => 'l5-health.health',
    'uses' => 'Ackly\\L5Health\\Http\\Controllers\\HealthController@index'
]);