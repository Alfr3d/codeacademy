<?php

namespace Alfred\MvcProject\Models;

class Car
{
    private string $registrationId;
    private string $manufacturer;
    private string $model;
    private int $year;

    public function setRegistrationId(string $registrationId): void
    {
        $this->registrationId = $registrationId;
    }

    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getRegistrationId(): string
    {
        return $this->registrationId;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}