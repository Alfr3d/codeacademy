<?php

class Person
{
    public function __construct(private string $name, private string $surname)
    {
    }

    public function __toString(): string
    {
        return sprintf( "This person is called %s %s", $this->name, $this->surname);
    }
}

/*
Paredaguokite klasę Person, kad veiktų šis kodas:
$person = new Person('John', 'Smith');
echo $person; // "This person is called John Smith"
*/

$person = new Person('John', 'Smith');
echo $person; // "This person is called John Smith"