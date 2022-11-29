<?php

class Divisor
{
    public function __construct(private int $maxNumber)
    {
    }

    public function __invoke(int $divisor): array
    {
        $divisorNumbersArray = [];

        for ($i = 1; $i <= $this->maxNumber; $i++) {
            if ($i % $divisor === 0) {
                $divisorNumbersArray[] = $i;
            }
        }

        return $divisorNumbersArray;
    }
}

/*
Sukurkite klasę, kuri masyvo formatu grąžintų visus skaičius nuo 1 iki X, kurie dalijasi iš tam tikro skaičiaus.
Klasė turi būti iškviečiama kaip funkcija, daliklis paduodamas kaip argumentas.
Skaičius X turi būti paduodamas per konstruktorių. Skaičius turi būti teigiamas.

[
    10,
    20,
    ...
]
*/

$divisor = new Divisor(1000);
print_r($divisor(10));