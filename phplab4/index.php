<?php
// Клас для зберігання та редагування колекції об'єктів, виводу даних на сторінку,
use Model\Car;
use Model\Car\Collection;
use Model\Car\Repository;

$dbh = new PDO('mysql:host=127.0.0.1;dbname=cars_db', 'root', '');
$sql = "SELECT * FROM cars;";
function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}
// заповнення бази даних
function insertInDb($carCollections,$dbh){
    foreach ($carCollections as $car){
        $sql = 'INSERT INTO сars(id, PIB, mark, number_car,color) VALUES ($car.getId(),$car.getPIB(),$car.getMark(),$car.getNumber_car(),$car.getColor())';
        $statement = $dbh->prepare($sql);
        $statement->execute([
                            $car->id,
                            $car->PIB,
                            $car->mark,
                            $car->number_car,
                            $car->color
                            ]);
        $result = $statement->fetchAll();
    }
    return $result;
}

spl_autoload_register('myAutoloader');

$car1 = new Car( 1,'Бартків Олександр Михайлович',"Audi","BB2588BA","red");
$car2 = new Car( 2,'Кучер Іван Андрійович',"BMW","AA6126ME","black");
$car3 = new Car( 3,'Візничук Андрій Андрійович',"Lexus","AK9265AK","blue");

$carCollections = new Collection([$car1,$car2,$car3]);
$saveCarCollection = new Repository();
$saveCarCollection->createNewFile('cars');
$saveCarCollection->storeDataToFile($carCollections, 'cars');
var_dump(insertInDb($carCollections,$dbh));
var_dump($carCollections);
echo '<br> ------------------ <br>';

$carCollections->removeCarByCode(1);

var_dump($carCollections);
// database
