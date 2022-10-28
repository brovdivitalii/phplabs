<?php

class DAI
{
    public int $id;
    public string $PIB;
    public string $mark;
    public string $number_car;
    public string $color;

    public function __construct(int $id, array $array)
    {
        $this->id = $id;
        $this->PIB = $array['PIB'];
        $this->mark = $array['mark'];
        $this->number_car = $array['number_car'];
        $this->color = $array['color'];
    }

    public static function validationDataCars($array): bool
    {
        return !(
            empty($array['PIB']) ||
            empty($array['mark']) ||
            empty($array['number_car']) ||
            empty($array['color']) ||
            !isset($array)
        );
    }
}