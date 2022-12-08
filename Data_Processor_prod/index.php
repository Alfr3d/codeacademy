<?php

declare(strict_types=1);


spl_autoload_register(function ($className) {
    if ($className === 'Processor\App') {
        require './src/App.php';
    }

    if ($className === 'Processor\Service\CategoryService') {
        require './src/Service/CategoryService.php';
    }

    if ($className === 'Processor\Service\DataProcessorService') {
        require './src/Service/DataProcessorService.php';
    }

    if ($className === 'Processor\Service\Encoder\EncoderInterface') {
        require './src/Service/Encoder/EncoderInterface.php';
    }

    if ($className === 'Processor\Service\Encoder\JsonEncoder') {
        require './src/Service/Encoder/JsonEncoder.php';
    }

    if ($className === 'Processor\Service\Encoder\XmlEncoder') {
        require './src/Service/Encoder/XmlEncoder.php';
    }

    if ($className === 'Processor\Service\OutputHandler\OutputHandlerInterface') {
        require './src/Service/OutputHandler/OutputHandlerInterface.php';
    }

    if ($className === 'Processor\Service\OutputHandler\FileOutputHandler') {
        require './src/Service/OutputHandler/FileOutputHandler.php';
    }

    if ($className === 'Processor\Service\OutputHandler\TerminalOutputHandler') {
        require './src/Service/OutputHandler/TerminalOutputHandler.php';
    }
});

$appObj = new Processor\App();
$appObj->execute();