<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/auth/login' => [[['_route' => 'auth_login', 'controller' => 'app\\Controllers\\UserController::login'], null, ['GET' => 0], null, false, false, null]],
        '/customers' => [
            [['_route' => 'customers_index', 'controller' => 'app\\Controllers\\CustomerController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'customers_store', 'controller' => 'app\\Controllers\\CustomerController::store'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'customers_update', 'controller' => 'app\\Controllers\\CustomerController::update'], null, ['PUT' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/customers/([0-9]+)(?'
                    .'|(*:29)'
                .')'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        29 => [
            [['_route' => 'customers_edit', 'controller' => 'app\\Controllers\\CustomerController::edit'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'customers_delete', 'controller' => 'app\\Controllers\\CustomerController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
