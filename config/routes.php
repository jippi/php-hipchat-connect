<?php
use Cake\Routing\Router;

Router::plugin('HipChat', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});
