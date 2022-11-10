<?php
namespace Model;

use Interface\CarInterface;

class Car implements CarInterface
{
    public function __construct(int $id = 0, string $PIB = "none", string $mark = "none", string $number_car = "none", string $color = "none")
    {
        $this->id = $id;
        $this->PIB = $PIB;
        $this->mark = $mark;
        $this->number_car = $number_car;
        $this->color = $color;
    }

    public function getCarWithRequest(string $request, array $args)
    {
        $newArray = array();
        $k = strlen($request);
        for($i = 0; $i < count($args); $i++){
            if (substr($args[$i]->number_car,0,$k) == $request){
                array_push($newArray,$args[$i]);
            }
        }
        return $newArray;
    }
    public function setId(int $id): CarInterface
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPIB(string $PIB): CarInterface
    {
        if ($PIB != "") {
            $this->PIB = $PIB;
        }
        return $this;
    }

    public function getPIB(): string
    {
        return $this->PIB;
    }

    public function setMark(string $mark): CarInterface
    {
        if ($mark != "") {
            $this->mark = $mark;
        }
        return $this;
    }

    public function getMark(): string
    {
        return $this->mark;
    }

    public function setNumber_car(string $number_car): CarInterface
    {
        if ($number_car != "") {
            $this->number_car = $number_car;
        }
        return $this;
    }

    public function getNumber_car(): string
    {
        return $this->number_car;
    }

    public function setColor(string $color): CarInterface
    {
        if ($color != "") {
            $this->color = $color;
        }
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}