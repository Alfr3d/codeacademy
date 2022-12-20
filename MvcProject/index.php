<?php

use Alfred\MvcProject\Framework\Router;
use Alfred\MvcProject\Container\DIContainer;

require_once './vendor/autoload.php';

// Load custom DI container
$container = new DIContainer();
$container->loadDependencies();

// Use custom Router
$requestUri = str_replace('/MvcProject', '', $_SERVER['REQUEST_URI']);
$router = $container->get(Router::class);
$router->process($requestUri);