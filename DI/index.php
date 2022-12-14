<?php

require_once './vendor/autoload.php';

use Codeacademy\Di\Processor\DataProcessor;

// Load custom DI container
$container = new \Codeacademy\Di\Config\Container();
$container->loadDependencies();

// Run APP
$app = new \Codeacademy\Di\App($container->get(DataProcessor::class));
$app->run();