<?php

namespace Processor\Service\OutputHandler;

class FileOutputHandler implements OutputHandlerInterface
{
    private const JSON_FILES_PATH = './src/Files/json/';
    private const XML_FILES_PATH = './src/Files/xml/';

    public function handle(string $encodedData, string $fileType = 'json'): void
    {
        switch ($fileType) {
            case 'json':
                $this->handleJson($encodedData);
                break;
            case 'xml':
                $this->handleXml($encodedData);
                break;
            default:
                die('exception');
                break;
        }
    }

    private function handleXml(string $encodedData): void
    {
        $filePath = self::XML_FILES_PATH . 'data_' . uniqid() . '.xml';
        file_put_contents($filePath, $encodedData);

        die('Done');
    }

    private function handleJson(string $encodedData): void
    {
        $filePath = self::JSON_FILES_PATH . 'data_' . uniqid() . '.json';
        file_put_contents($filePath, $encodedData);

        die('Done');
    }
}