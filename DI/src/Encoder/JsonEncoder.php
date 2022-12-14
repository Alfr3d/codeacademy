<?php

namespace Codeacademy\Di\Encoder;

class JsonEncoder
{
    public function encode(array $data): string
    {
        return json_encode($data);
    }
}