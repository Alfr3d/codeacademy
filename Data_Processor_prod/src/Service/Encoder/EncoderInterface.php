<?php

namespace Processor\Service\Encoder;

interface EncoderInterface
{
    public function encode(array $data): string;
}