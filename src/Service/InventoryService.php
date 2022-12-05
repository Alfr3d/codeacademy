<?php

namespace MyProject\Service;

use MyProject\Exception\InventoryException;

class InventoryService
{
    private const INVENTORY_FILE_PATH = './src/File/Inventory/inventory.json';
    private const LOG_FILE_PATH = './src/File/Log/log.txt';
    private const PRODUCT_ID_POSITION = 0;
    private const PRODUCT_QUANTITY_POSITION = 1;
    private const SUCCESS_MESSAGE = 'All products have the requested quantity in stock';

    public function checkInventory(string $productsInfo): string
    {
        $inventoryArray = $this->getInventoryAsArray();
        $productsForCheck = $this->getProductsForCheck($productsInfo);

        foreach ($productsForCheck as $productForCheck) {
            if (!isset($inventoryArray[$productForCheck[self::PRODUCT_ID_POSITION]])) {
                $message = sprintf(
                    'product "%s" is not in the inventory',
                    $productForCheck[self::PRODUCT_ID_POSITION]
                );
                $this->createLog($message);

                throw new InventoryException($message);
            }

            $productForCheckQuantity = $productForCheck[self::PRODUCT_QUANTITY_POSITION];
            $productInInventoryQuantity = $inventoryArray[$productForCheck[self::PRODUCT_ID_POSITION]]['quantity'];

            if ($productForCheckQuantity > $productInInventoryQuantity) {
                $message = sprintf(
                    'product "%s" only has %s items in the inventory',
                    $productForCheck[self::PRODUCT_ID_POSITION],
                    $productInInventoryQuantity
                );

                throw new InventoryException($message);
            }
        }

        return self::SUCCESS_MESSAGE;
    }

    private function getInventoryAsArray(): array
    {
        $inventoryArray = json_decode(file_get_contents(self::INVENTORY_FILE_PATH), true);
        $indexedInventoryArray = [];

        foreach ($inventoryArray as $inventoryItem) {
            $indexedInventoryArray[$inventoryItem['product_id']] = $inventoryItem;
        }

        return $indexedInventoryArray;
    }

    private function getProductsForCheck(string $productsInfo): array
    {
        $productsArray = explode(',', $productsInfo);
        $products = [];

        foreach ($productsArray as $productArray) {
            $products[] = explode(':', $productArray);
        }

        return $products;
    }

    private function createLog(string $message): void
    {
        $message = date('Y-m-d H:i:s') . ' ' . $message . PHP_EOL;
        file_put_contents(self::LOG_FILE_PATH, $message, FILE_APPEND);
    }
}