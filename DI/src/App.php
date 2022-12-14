<?php

namespace Codeacademy\Di;

use Codeacademy\Di\Processor\DataProcessor;

class App
{
    public function __construct(private DataProcessor $dataProcessor)
    {
    }

    public function run(): void
    {
        $data = ['test'];
        echo $this->dataProcessor->process($data);
    }
}