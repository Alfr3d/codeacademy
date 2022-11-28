<?php

declare(strict_types=1);

/*
1.1
Parašykite klasę KilometerConverter
Į konstruktorių turi būti paduodamas atstumas kilometrais (float).
Klasė turi turėti metodus, kuriuos būtų galima kviesti iš klasės išorės:
- convertToNauticalMiles()
- convertToMiles()
- convertToYards()
- convertToCentimeters()
Svarbu: Konvertavimo matmenys (pvz nautical mile = 1.852) turi būti saugomi klasės konstantose.
$a = new KilometerConverter(55);
echo $a->convertToCentimeters();
1.2 Klasei KilometerConverter pridėkite statinį metodą, kuris gali būti kviečiamas iš klasės išorės:
- getConversionRates(). Šis metodas turi grąžinti masyvą su visais konvertavimo matmenimis:
Šio metodo kvietimo rezultatas turetų būti:
[
    'nautical_mile' => 1.852,
    'mile' => 1.60934,
    'yard' => 0.0009144,
    'centimeter' => 1.0E-5,
]
Svarbu: naudokite klasės konstantas.
1.3
Įgyvendinkite konvertavimo logiką panaudojant abstrakčią klasę.
Sukurkite abstrakčią klasę AbstractKilometerConverter. Ši klasė turės vieną metodą: convert().
Iš šios klasės sukurkite 4 išvestines klases, kurių kiekviena implementuotų metodą convert()
ir atliktų tik tai klasei pavestą konversiją:
- NauticalMileConverter
- MileConverter
- YardConverter
- CentimeterConverter
Pavyzdys:
$centimeterConverter = new CentimeterConverter(100);
echo $centimeterConverter->convert();
*/

class KilometerConverter
{
    private const NAUTICAL_MILE_TO_KILOMETER = 1.852;
    private const MILE_TO_KILOMETER = 1.60934;
    private const YARD_TO_KILOMETER = 0.0009144;
    private const CENTIMETER_TO_KILOMETER = 1.0E-5;

    public function __construct(private float $kilometers)
    {
    }

    public function convertToNauticalMiles(): float
    {
        return $this->kilometers / self::NAUTICAL_MILE_TO_KILOMETER;
    }

    public function convertToMiles(): float
    {
        return $this->kilometers / self::MILE_TO_KILOMETER;
    }

    public function convertToYards(): float
    {
        return $this->kilometers / self::YARD_TO_KILOMETER;
    }

    public function convertToCentimeters(): float
    {
        return $this->kilometers / self::CENTIMETER_TO_KILOMETER;
    }

    public static function getConversionRates(): array
    {
        return [
            'nautical_mile' => self::NAUTICAL_MILE_TO_KILOMETER,
            'mile' => self::MILE_TO_KILOMETER,
            'yard' => self::YARD_TO_KILOMETER,
            'centimeter' => self::CENTIMETER_TO_KILOMETER,
        ];
    }
}


abstract class AbstractKilometerConverter
{
    public function __construct(protected float $kilometers)
    {
    }

    abstract public function convert(): float;
}

class NauticalMileConverter extends AbstractKilometerConverter
{
    private const NAUTICAL_MILE_TO_KILOMETER = 1.852;

    public function convert(): float
    {
        return $this->kilometers / self::NAUTICAL_MILE_TO_KILOMETER;
    }
}

$newObj = new NauticalMileConverter(55);
echo $newObj->convert();
