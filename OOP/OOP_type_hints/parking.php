<?php

declare(strict_types=1);

/*
Sukurkite programą skirtą valdyti parkingą. Naudokite objektinį programavimą t.y. klases.
Turbūt pakaks dviejų klasių - Parking ir Car. Duomenys turi būti saugomi faile.
---------------------------------------------
php -f parking.php park_car NKA_123
Car ABC_123 parked!
---------------------------------------------
php -f parking.php park_car FTA_122
Car FTA_122 parked!
---------------------------------------------
php -f parking.php list_cars
Parked cars:
NKA_123
FTA_122
*/

class Car
{
    public function __construct(private string $carNumber)
    {
    }

    public function getCarNumber(): string
    {
        return $this->carNumber;
    }
}

class Parking
{
    private const PARKED_CARS_FILE_PATH = './parkedCars.json';

    public function addCar(Car $car): void
    {
        $parkedCars = $this->getParkedCarsInfo();
        $parkedCars[] = $car->getCarNumber();
        $this->updateParkedCarsInfo($parkedCars);
        echo sprintf('Car %s parked!', $car->getCarNumber());
    }

    public function printParkedCarsList(): void
    {
        $parkedCars = $this->getParkedCarsInfo();

        foreach ($parkedCars as $parkedCar) {
            echo $parkedCar . '<br>';
        }
    }

    private function getParkedCarsInfo(): array
    {
        return json_decode(file_get_contents(self::PARKED_CARS_FILE_PATH), true);
    }

    private function updateParkedCarsInfo(array $parkedCars): void
    {
        file_put_contents(self::PARKED_CARS_FILE_PATH, json_encode($parkedCars));
    }

    public function removeCarFromParking(Car $car): void
    {

    }
}

$newCarObj = new Car('AAA_111');
$newCarObj2 = new Car('AAA_222');
$newCarObj3 = new Car('AAA_333');
$newCarObj4 = new Car('AAA_444');
$newCarObj5 = new Car('AAA_555');

$parkingObj = new Parking();
$parkingObj->addCar($newCarObj);
echo '<hr>';
$parkingObj->addCar($newCarObj2);
echo '<hr>';
$parkingObj->addCar($newCarObj3);
echo '<hr>';
$parkingObj->addCar($newCarObj4);
echo '<hr>';
$parkingObj->addCar($newCarObj5);
echo '<hr>';
$parkingObj->printParkedCarsList();