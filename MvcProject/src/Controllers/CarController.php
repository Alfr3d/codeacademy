<?php

namespace Alfred\MvcProject\Controllers;

use Alfred\MvcProject\Repositories\CarRepository;

class CarController
{
    public function __construct(private CarRepository $carRepository)
    {
    }

    public function list(): void
    {
        $cars = $this->carRepository->getAll();

        require(__DIR__ . '/../Views/car/list.tpl');
    }

    public function details(string $registrationId): void
    {
        $carObj = $this->carRepository->getByRegistrationId($registrationId);

        require(__DIR__ . '/../Views/car/details.tpl');
    }
}