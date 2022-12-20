<?php

namespace Alfred\MvcProject\Repositories;

use Alfred\MvcProject\Models\Car;

class CarRepository
{
    private const DATA_FILE = './src/Files/cars.json';

    public function getByRegistrationId(string $registrationId): Car
    {
        $data = $this->getDecodedJsonData();
        foreach ($data as $carData) {
            if ($carData['registrationId'] === $registrationId) {
                $carObj = new Car();
                $carObj->setRegistrationId($carData['registrationId']);
                $carObj->setManufacturer($carData['manufacturer']);
                $carObj->setModel($carData['model']);
                $carObj->setYear($carData['year']);
            }
        }

        if (isset($carObj)) {
            return $carObj;
        } else {
            throw new \Exception('Car with registrationId not found');
        }
    }

    public function getAll(): array
    {
        return [];
    }

    private function getDecodedJsonData(): array
    {
        return json_decode(file_get_contents(self::DATA_FILE), true);
    }
}