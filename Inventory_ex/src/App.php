<?php

namespace Codeacademy\Inventory;

use Codeacademy\Inventory\Validator\InputValidator;
use Codeacademy\Inventory\Service\InventoryService;
use Codeacademy\Inventory\Exception\InventoryException;
use Codeacademy\Inventory\Exception\InputValidationException;

class App
{
    public function execute(): void
    {
        try {
            $productsToCheck = "12:121,2:3,4:1";
            InputValidator::validate($productsToCheck);

            $inventoryService = new InventoryService();
            echo $inventoryService->checkInventory($productsToCheck);
        } catch (InventoryException|InputValidationException $exception) {
            die($exception->getMessage());
        }
    }
}