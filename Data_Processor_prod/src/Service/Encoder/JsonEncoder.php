<?php

namespace Processor\Service\Encoder;

class JsonEncoder implements EncoderInterface
{
    public function encode(array $data): string
    {
        return json_encode($data);
    }
}