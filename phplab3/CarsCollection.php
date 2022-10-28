<?php


class CarsCollection
{
    public array $cars=[];

    public function __construct()
    {
    }

    public function defaultCars(): CarsCollection
    {
        $this->cars = [
            new DAI(1, [
                "id" => 1,
                "PIB" => "Бартків Олександр Михайлович",
                "mark" => "Audi",
                "number_car" => "BB2588BA",
                "color" => "red",
            ]),
            new DAI(2, [
                "id" => 2,
                "PIB" => "Кучер Іван Андрійович",
                "mark" => "BMW",
                "number_car" => "AA6126ME",
                "color" => "black",
            ]),
            new DAI(3, [
                "id" => 3,
                "PIB" => "Візничук Андрій Андрійович",
                "mark" => "Lexus",
                "number_car" => "AK9265AK",
                "color" => "blue",
            ]),
            new DAI(4, [
                "id" => 4,
                "PIB" => "Ткаченко Ірина Михайлівна",
                "mark" => "Tesla",
                "number_car" => "AK2452HH",
                "color" => "black",
            ])
        ];
        return $this;
    }

    public function getCarById($id)
    {
        foreach ($this->cars as $car) {
            if ($car->id == $id) {
                return $car;
            }
        }
        return null;
    }

    public function filterCars($request): array
    {
        return array_filter(
            $this->cars,
            function ($value) use ($request) {
                return (mb_substr($value->number_car, 0, mb_strlen($request)) == $request);
            }
        );
    }

    public function addCar($car)
    {
        $this->cars[] = $car;
    }

    public function editCar($array)
    {
        $car = $this->getCarById($array['id']);
        if (!(empty($car))) {
            $car->PIB = $array['PIB'];
            $car->mark = $array['mark'];
            $car->number_car = $array['number_car'];
            $car->color = $array['color'];
        }
    }

    public function saveCars()
    {
        $file = fopen("cars.txt", "w");
        fwrite($file, serialize($this->cars));
        fclose($file);
    }

    public function loadCars()
    {
        $this->cars = unserialize(file_get_contents("cars.txt"));
    }

    public function displayCars(): string
    {
        $table = '<table>';
        $table .= '<tr> <tr> <th> id </th> <th> PIB </th> <th> mark</th> <th> number_car</th> <th> color</th></tr></tr>';

        foreach ($this->cars as $item) {
            $table .= "<tr><td>$item->id</td><td>$item->PIB</td><td>$item->mark</td>" .
                "<td>$item->number_car</td><td>$item->color</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }

    public function displayFilteredCars($request): string
    {
        $array = $this->filterCars($request);
        $table = '<table>';
        $table .= '<tr> <th> id </th> <th> PIB </th> <th> mark</th> <th> number_car</th> <th> color</th></tr>';

        foreach ($array as $item) {
            $table .= "<tr><td>$item->id</td><td>$item->PIB</td><td>$item->mark</td>" .
                "<td>$item->number_car</td><td>$item->color</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}