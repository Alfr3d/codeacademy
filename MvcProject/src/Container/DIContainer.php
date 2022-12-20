<?php

namespace Alfred\MvcProject\Container;

use Alfred\MvcProject\Controllers\CarController;
use Alfred\MvcProject\Controllers\HomePageController;
use Alfred\MvcProject\Framework\Router;
use Alfred\MvcProject\Models\Car;
use Alfred\MvcProject\Repositories\CarRepository;
use RuntimeException;

class DIContainer
{
    private array $entries = [];

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new RuntimeException('Class ' . $id . 'not found in container.');
        }
        $entry = $this->entries[$id];

        return $entry($this);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $callable): void
    {
        $this->entries[$id] = $callable;
    }

    public function loadDependencies()
    {
        $this->set(
            CarController::class,
            function (DIContainer $container) {
                return new CarController(
                    $container->get(CarRepository::class)
                );
            }
        );

        $this->set(
            Router::class,
            function (DIContainer $container) {
                return new Router(
                    $container->get(HomePageController::class),
                    $container->get(CarController::class)
                );
            }
        );

        $this->set(
            Car::class,
            function (DIContainer $container) {
                return new Car();
            }
        );

        $this->set(
            CarRepository::class,
            function (DIContainer $container) {
                return new CarRepository();
            }
        );

        $this->set(
            HomePageController::class,
            function (DIContainer $container) {
                return new HomePageController();
            }
        );
    }
}