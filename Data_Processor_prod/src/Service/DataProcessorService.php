<?php

namespace Processor\Service;

use Processor\Service\Encoder\JsonEncoder;
use Processor\Service\Encoder\XmlEncoder;
use Processor\Service\OutputHandler\FileOutputHandler;
use Processor\Service\OutputHandler\OutputHandlerInterface;
use Processor\Service\OutputHandler\TerminalOutputHandler;

class DataProcessorService
{
    public function __construct(private array $data)
    {
    }

    public function process(string $format, string $output): void
    {
        // encode data to $format (JSON or XML)
        $encodedData = $this->processFormat($format);

        // output it to $output (file or terminal)
        $outputHandler = $this->processOutput($output);

        $outputHandler->handle($encodedData);
    }

    private function processFormat(string $format): string
    {
        if ($format === 'json') {
            $encoder = $this->getJsonEncoder();
        } else if ($format === 'xml') {
            $encoder = $this->getXmlEncoder();
        } else {
            die('Bad format. You must use "json" or "xml"');
        }

        return $encoder->encode($this->data);
    }

    private function processOutput(string $output): OutputHandlerInterface
    {
        switch ($output) {
            case 'terminal':
                $outputHandler = $this->getTerminalOutputHandler();
                break;
            case 'file':
                $outputHandler = $this->getFileOutputHandler();
                break;
            default:
                die('exception');
                break;
        }

        return $outputHandler;
    }

    private function getTerminalOutputHandler(): TerminalOutputHandler
    {
        return new TerminalOutputHandler();
    }

    private function getFileOutputHandler(): FileOutputHandler
    {
        return new FileOutputHandler();
    }

    private function getJsonEncoder(): JsonEncoder
    {
        return new JsonEncoder();
    }

    private function getXmlEncoder(): XmlEncoder
    {
        return new XmlEncoder();
    }
}