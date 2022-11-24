<?php

declare(strict_types=1);

class Animal
{
    public function __construct(protected string $name)
    {
    }

    public function run(): void
    {
        $this->moveLegs();
        $this->moveTail();
    }

    protected function moveLegs(): void
    {
        echo  $this->name . ' is moving legs <br>';
    }

    protected function moveTail(): void
    {
        echo $this->name . ' is moving tail <br>';
    }
}

class Dog extends Animal
{
    protected function moveLegs(): void
    {
        echo $this->name . ' is moving legs <br>';
    }

    protected function moveTail(): void
    {
        echo $this->name . ' is moving tail <br>';
    }

    public function flip(): void
    {
        echo $this->name .  ' will do flip <br>';
    }
}

class Bulldog extends Dog
{

}

$animalObj = new Animal('Animal');
$animalObj->run();

echo '<hr>';

$dogObj = new Dog('Doggi');
$dogObj->run();
$dogObj->flip();

$bullDog = new Bulldog('Buldoggi');
$bullDog->run();