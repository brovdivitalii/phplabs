<?php
namespace Interface;

interface CarCollectionInterface
{
    public function addCar(CarInterface $car): CarCollectionInterface;

    public function removeCarByCode(int $id): CarCollectionInterface;
}
