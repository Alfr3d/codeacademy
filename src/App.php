<?php

namespace MyProject;

use MyProject\Validator\InputValidator;
use MyProject\Service\InventoryService;
use MyProject\Exception\InventoryException;
use MyProject\Exception\InputValidationException;

class App
{
    public function execute(): void
    {
        try {
            $productsToCheck = "9:121,2:3,4:1";
            InputValidator::validate($productsToCheck);

            $inventoryService = new InventoryService();
            echo $inventoryService->checkInventory($productsToCheck);
        } catch (InventoryException|InputValidationException $exception) {
            die($exception->getMessage());
        }
    }
}