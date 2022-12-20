<?php

namespace Alfred\MvcProject\Framework;

use Alfred\MvcProject\Controllers\CarController;
use Alfred\MvcProject\Controllers\HomePageController;

class Router
{
    public function __construct(
        private HomePageController $homePageController,
        private CarController $carController
    ) {
    }

    public function process(string $route)
    {
        switch ($route) {
            case '/':
                echo $this->homePageController->renderHomePage();
                break;
            case '/car/details':
                echo $this->carController->details();
                break;
            case '/car/list':
                echo $this->carController->list();
                break;
            default:
                http_response_code(404);
                echo $this->homePageController->renderNotFoundPage();
                break;
        }
    }
}