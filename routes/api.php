<?php

use App\Event\Http\Controllers\EventController;
use Dingo\Api\Routing\Router;

$app = app(Router::class);

$app->version('v1', ['middleware' => ['api.auth']], function (Router $router) {
    $router->get('calendar/event/active', [EventController::class, 'indexActive'])->withoutMiddleware('api.auth');
    $router->get('calendar/event/{id}', [EventController::class, 'show']);
    $router->post('calendar/event', [EventController::class, 'store']);
    $router->put('calendar/event/{id}', [EventController::class, 'update']);
    $router->delete('calendar/event/{id}', [EventController::class, 'destroy']);
});


