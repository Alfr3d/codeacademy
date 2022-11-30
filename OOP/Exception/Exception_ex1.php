<?php

declare(strict_types=1);

/*
1.1 Parašykite įrankį slaptažodžio stiprumui nustatyti.
Slaptažodis turi:
- būti sudarytas iš ne mažiau 10 simblių
- turi turėti bent 2 skirtingus specialiuosius simbolius (!@#$%^&*_)
- turi turėti ir mažųjų, ir didžiųjų raidžių (aB)
- turi turėti bent vieną skaitmenį (0-9)
Slaptažodžio validavimas turi vykti klasėje PasswordValidator.
Validatorius, atradęs taisyklės pažeidimą, turi mesti exception'ą su žinute (pvz.: "Password must be at least ten symbols long")
Kodas, kviečiantis validatorių turi gaudyti exception'ą ir spausdinti žinutę terminale.
Jeigu slaptažodis atitinka reikalavimus, spausdinkite "Password is valid"
Failo kvietimo pavyzdys:
php -f 1_password_validator.php 123456
Password must be at least 10 symbols long
php -f 1_password_validator.php 123456aBc!@
Password is valid
1.2 Patobulinkite validatoriu. Validatorius turi sukaupti visas klaidas ir jas išspausdinti.
Failo kvietimo pavyzdys:
php -f 1_password_validator.php 123456
Password must be at least 10 symbols long
Password must contain at least 2 special symbols (!@#$%^&*_)
Password must contain uppercase and lowercase letters
*/

class PasswordValidator
{
    public function validate(string $password): void
    {
        $errorsMsg = '';

        if (!$this->validateLength($password)) {
            $errorsMsg .= 'Length exception' . PHP_EOL;
        }

        if (!$this->validateSpecialChars($password)) {
            $errorsMsg .= 'Special chars exception' . PHP_EOL;
        }

        if (!$this->validateLetters($password)) {
            $errorsMsg .= 'Letters exception' . PHP_EOL;
        }

        if (!$this->validateNumber($password)) {
            $errorsMsg .= 'Number exception' . PHP_EOL;
        }

        if (!empty($errorsMsg)) {
            throw new Exception($errorsMsg);
        } else {
            echo 'Password is Valid' . PHP_EOL;
        }
    }

    private function validateLength(string $password): bool
    {
        return strlen($password) >= 10;
    }

    private function validateSpecialChars(string $password): bool
    {
        $specialCharacters = ['!', '@', '#', '$', '%', '^', '&', '*', '_'];
        $specialCharactersCount = 0;

        foreach ($specialCharacters as $specialCharacter) {
            if (str_contains($password, $specialCharacter)) {
                $specialCharactersCount += 1;
            }
        }

        return $specialCharactersCount >= 2;
    }

    private function validateLetters(string $password): bool
    {
        $result = true;

        if (!preg_match('@[A-Z]@', $password)) {
            $result = false;
        }

        if (!preg_match('@[a-z]@', $password)) {
            $result = false;
        }

        return $result;
    }

    private function validateNumber(string $password): bool
    {
        return (bool) preg_match('@[0-9]@', $password);
    }
}

try {
    $passwordValidator = new PasswordValidator();
    $passwordValidator->validate('asbfkd@13AA!k');
} catch (Exception $e) {
    echo $e->getMessage();
}

