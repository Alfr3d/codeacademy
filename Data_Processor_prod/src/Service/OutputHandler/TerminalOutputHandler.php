<?php

namespace Processor\Service\OutputHandler;

class TerminalOutputHandler implements OutputHandlerInterface
{
    public function handle(string $encodedData): void
    {
        echo $encodedData;
        die;
    }
}