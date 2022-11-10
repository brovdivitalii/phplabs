<?php
namespace Model\Car;

use Interface\CarInterface;
use Interface\CarCollectionInterface;

class Collection implements CarCollectionInterface
{
    public function __construct($carArr = [])
    {
        $this->carArr = $carArr;
    }

    public function getCarArr()
    {
        return $this->carArr;
    }

    public function setCarArr($carArr = []): CarCollectionInterface
    {
        $this->carArr = $carArr;
        return $this;
    }

    public function addCar(CarInterface $car): CarCollectionInterface
    {
        $this->carArr[] = $car;
        return $this;
    }

    public function removeCarByCode(int $id): CarCollectionInterface
    {
        for ($i = 0; $i < count($this->carArr); $i++) {
            if ($this->carArr[$i]->id == $id) {
                unset($this->carArr[$i]);
            }
        }
        return $this;
    }
}
