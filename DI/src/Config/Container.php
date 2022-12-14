<?php

namespace Codeacademy\Di\Config;

use Codeacademy\Di\Encoder\JsonEncoder;
use Codeacademy\Di\Processor\DataProcessor;
use RuntimeException;

class Container
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
            JsonEncoder::class,
            function (Container $container) {
                return new JsonEncoder();
            }
        );
        $this->set(
            DataProcessor::class,
            function (Container $container) {
                return new DataProcessor($container->get(JsonEncoder::class));
            }
        );
    }
}