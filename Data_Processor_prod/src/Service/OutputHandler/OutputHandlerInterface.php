<?php

namespace Processor\Service\OutputHandler;

interface OutputHandlerInterface
{
    public function handle(string $encodedData): void;
}