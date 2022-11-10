<?php
namespace Model\Car;

use Interface\CarCollectionInterface;
use Model\Car;

class Repository
{
    public function createNewFile(string $fileName){
        $file = fopen("./$fileName.txt",'w+');
        fclose($file);
    }
    public function loadDataFromFile(string $fileName): CarCollectionInterface
    {
        $lines = file("./$fileName.txt", FILE_SKIP_EMPTY_LINES);
        $dict = new Collection([]);
        foreach ($lines as $line) {
            $lineArr = explode(' ', $line);

            $dict->addCar(new Car((int)$lineArr[0], $lineArr[1], (int)$lineArr[2], $lineArr[3], $lineArr[4]));
        }
        return $dict;
    }

    public function storeDataToFile(CarCollectionInterface $carCollection, string $fileName)
    {
        $dataStr = '';
        for($i = 0; $i < count($carCollection->getCarArr()); $i++){
            $dataStr .= $carCollection->getCarArr()[$i]->getId() . ' ' .
                $carCollection->getCarArr()[$i]->getPIB() . ' ' .
                $carCollection->getCarArr()[$i]->getMark() . ' ' .
                $carCollection->getCarArr()[$i]->getNumber_car() . ' ' .
                $carCollection->getCarArr()[$i]->getColor() . "\n";
        }
        file_put_contents("./$fileName.txt", "$dataStr", FILE_APPEND);
    }
}
