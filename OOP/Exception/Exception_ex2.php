<?php

declare(strict_types=1);

class InventoryException extends Exception
{
}

class InputValidationException extends Exception
{
}

class InventoryService
{
    private const INVENTORY_FILE_PATH = './inventory.json';
    private const LOG_FILE_PATH = './log.txt';
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

class InputValidator
{
    public static function validate(string $productsInfo): void
    {
        $productsArray = explode(',', $productsInfo);

        foreach ($productsArray as $product) {
            if (!preg_match('/\d(:)\d/', $product)) {
                $message = sprintf(
                    'Invalid input "%s". Format: id:quantity,id:quantity',
                    $productsInfo
                );

                throw new InputValidationException($message);
            }
        }
    }
}

try {
    $productsToCheck = "1:122,2:3,4:1";
    InputValidator::validate($productsToCheck);

    $inventoryService = new InventoryService();
    echo $inventoryService->checkInventory($productsToCheck);
} catch (InventoryException|InputValidationException $exception) {
    die($exception->getMessage());
}



/*
2.1 Parašykite įrankį inventoriaus tikrinimui. Inventorių rasite faile "./inventory.json"
Programa turėtų veikti paduodant jai produkto id ir kiekio poras, atskirtas dvitaškiu. Pačios poros atskirtos kableliais:
Pvz.: php -f 2_inventory_checker.php "1:3,2:2,4:1" - reiškia, kad mes norime patikrinti, ar inventoriuje egzistuoja:
- produktas, kurio id yra 1, o kiekis 3
- produktas, kurio id yra 2, o kiekis 2
- produktas, kurio id yra 4, o kiekis 1
Jeigu paduotas produkto id neegzistuoja, arba nepakanka kiekio, į terminalą išspausdinkite pranešimą:
- product "15" is not in the inventory
- product "5" only has 0 items in the inventory
Pakaks spausdinti tik vieną klaidą apie inventoriaus neatitikimus, net jeigu tikrinami keli nevalidūs produktai.
Šalia klaidos pranešimo spausdinimo taip pat, įrašykite pranešimą apie šį įvykį į log'ą (log.txt)
Log'o įrašo formatas: 2020-01-01 15:15:15 product "15" is not in the inventory
Užduočiai įgyvendinti panaudokite exception'us.
Klasė, tikrinanti inventorių, turi mesti exception'us, o ją kviečiantis kodas - gaudyti. Naudokite savo custom
exception'o klasę (pvz.: InventoryException).
Programos kvietimo pavyzdys:
php -f 2_inventory_checker.php "1:3,2:2,5:1"
product "5" only has 0 items in the inventory
php -f 2_inventory_checker.php "1:3,2:2"
all products have the requested quantity in stock
*/

/*
2.2 Patobulinkite 2.1 užduoties įrankį - pridėkite inputo validatorių (atskira klasė)
Šis validatorius turi užfiksuoti, kad šie inputai nėra validūs:
- "q:3,2:2,5:1"
- "-:3,2:2,5:1"
- "3,2:2,5:1"
Kai užfiksuojamas nevalidus inputas, programa turi į komandinę eilutę išspausdinti šį pranešimą:
Invalid input "3,2:2,5:1". Format: id:quantity,id:quantity
Klaidingo inputo atveju į log'ą rašyti pranešimo nereikia.
Svarbu: Abi klasės (inventoriy checkeris ir input validatorius) turi būti kviečiami tame pačiame "try" bloke.
Naudokite savo custom exception'o klasę (pvz.: InputValidationException).
Programos kvietimo pavyzdys:
php -f 2_inventory_checker.php "3,2:2,5:1"
Invalid input "3,2:2,5:1". Format: id:quantity,id:quantity
*/