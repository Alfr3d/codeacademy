<?php

use Alfred\MvcProject\Framework\Router;
use Alfred\MvcProject\Container\DIContainer;

require_once './vendor/autoload.php';

// Load custom DI container
$container = new DIContainer();
$container->loadDependencies();

// Use custom Router
$requestUri = str_replace('/MvcProject', '', $_SERVER['REDIRECT_URL']);
$registrationId = $_SERVER['QUERY_STRING'];

$router = $container->get(Router::class);
$router->process($requestUri, $registrationId);