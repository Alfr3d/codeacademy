<?php

namespace Codeacademy\Di\Processor;

use Codeacademy\Di\Encoder\JsonEncoder;

class DataProcessor
{
    public function __construct(private JsonEncoder $encoder)
    {
    }

    public function process(array $data): string
    {
        // do some processing on $data
        // and then return encoded to JSON
        return $this->encoder->encode($data);
    }
}