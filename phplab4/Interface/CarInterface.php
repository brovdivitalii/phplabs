<?php
namespace Interface;

interface CarInterface
{
    public function setId(int $id): CarInterface;

    public function getId(): int;

    public function setPIB(string $PIB): CarInterface;

    public function getPIB(): string;

    public function setMark(string $mark): CarInterface;

    public function getMark(): string;

    public function setNumber_car(string $number_car): CarInterface;

    public function getNumber_car(): string;

    public function setColor(string $color): CarInterface;

    public function getColor(): string;
}
