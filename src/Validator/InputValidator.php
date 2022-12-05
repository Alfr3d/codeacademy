<?php

namespace MyProject\Validator;

use MyProject\Exception\InputValidationException;

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