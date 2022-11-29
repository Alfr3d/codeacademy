<?php

class Calculator
{
    public static function sum(int $a, int $b): int
    {
        return $a + $b;
    }

    public static function subtract(int $a, int $b): int
    {
        return $a - $b;
    }

    public static function multiply(int $a, int $b): int
    {
        return $a * $b;
    }

    public static function divide(int $a, int $b): ?float
    {
        if ($b === 0) {
            return NULL;
        }

        return $a / $b;
    }


    public static function __callStatic(string $name, array $arguments)
    {
        if (!str_ends_with($name, 'Timer')) {
            throw new Error('Unknown method');
        }

        $methodName = str_replace('Timer', '', $name);

        if (!method_exists(Calculator::class, $methodName)) {
            throw new Error('Unknown method');
        }

        $iterations = $arguments[0];

        $start = microtime(true);

        for ($i = 1; $i <= $iterations; $i++) {
            self::$methodName(rand(), rand());
        }

        $end = microtime(true);
        $res = $end - $start;

        return sprintf('It took %s to do %d %s() operations', $res, $iterations, $methodName);
    }
}

//$calc = new Calculator();

echo Calculator::divideTimer(1000000);

/*
1.0 - pasiruošimas
Klasei pridėkite veikiančius metodus sum($a, $b), subtract($a, $b)
Dirbama su sveikaisiais skaičiais (int)
Panaudojimo pavyzdys:
$calc = new Calculator();
$calc->sum(1, 4); // grąžina 5
$calc->subtract(10, 1); // grąžina 9

1.1
Užduotį atlikti per magišką metodą, kuris paminėtas paskaitos skaidrėse.
Norime, kad klasė skaičiuotų bet savo metodų vykdymo trukmę, N kartų kviečiant ją su atsitiktinėmis reikšmėmis.
Chronometras kviečiamas per funkciją pavadinimu "<operacija>Timer" perduodant įvykdymų kiekį:
$calc->sumTimer(5000); // 5000 kartų kviečiamas sum() metodas su atsitiktinėmis reikšmėmis
$calc->subtractTimer(1_000_000); // milijoną kartų kviečiamas subtract() metodas su atsitiktinėmis reikšmėmis
Chronometras per echo() išveda:
'It took 0.017563104629517 to do 5000 sum() operations'
- Paskaitos skaidrėse rasite magišką metodą, kuris leis jums atlikti užduotį
- atsitiktines reikšmės generuojame su rand() arba random_int()
- Laikas skaičiuojamas su microtime(true) pagalba
- Kintamo metodo kvietimas turint string (Example #2): https://www.php.net/manual/en/functions.variable-functions.php

1.2
Magiškojo metodo apdorojimas:
- jeigu kviečiamas metodas nesibaigia su Timer(), mesti klaidą
  str_ends_with()
  throw new Error('Unknown method');
  Pvz $calc->sumTimerr()
- jeigu kviečiamas chronometras neegzistuojančiai bazinei funkcijai, irgi mesti klaidą
  method_exists()
  Pvz $calc->summTimer();

1.3
Klasei pridėkite metodą multiply() (daugyba), išbandykite $calc->multiplyTimer(1_000_000);
Galite pridėti ir divide(), tačiau turite apsisaugoti nuo dalybos iš nulio
---------
Kadangi klasė neturi vidinės būsenos, objektų naudojimas neprivalomas.
Užduotį galima atlikti ir su statiniais metodais (funkcijomis).
Tokiu atveju naudojamas kitas magiškas metodas.
*/