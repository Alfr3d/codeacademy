<?php

declare(strict_types=1);

spl_autoload_register(function ($className) {
    if ($className === 'MyProject\App') {
        require './src/App.php';
    }

    if ($className === 'MyProject\Validator\InputValidator') {
        require './src/Validator/InputValidator.php';
    }

    if ($className === 'MyProject\Service\InventoryService') {
        require './src/Service/InventoryService.php';
    }

    if ($className === 'MyProject\Exception\InputValidationException') {
        require './src/Exception/InputValidationException.php';
    }

    if ($className === 'MyProject\Exception\InventoryException') {
        require './src/Exception/InventoryException.php';
    }
});

$appObj = new MyProject\App();
$appObj->execute();