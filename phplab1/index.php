<?php
/*
1. Описати літерал нумерованого масиву із 5 -7 масивів з текстовими ключами, що містять дані про об'єкти згідно із варіантом .
2. Вивести дані про об'єкти в таблицю.
3. Підготувати функцію для вибору всіх елементів масиву, що відповідають запиту. Вивести їх в таблицю.
4. Передбачити можливість передачі параметрів запиту через рядок стану
5. Створити форму для додавання нового об'єкту до масиву.
6. Створити форму редагування даних про об'єкт.
7. Перед редагуванням здійснити валідацію даних (ПІБ не може бути порожнім рядком, заробітна плата повинна бути невід'ємним числом, тощо).
Об’єкт “ДАІ” (Код, ПІБ власника машини; марка, номер машини; колір).
 Запит автомобілів марки Х, номери яких починаються із вказаного шаблону. */


$_SESSION['$DAI'] = null;

$request = $_GET["request"];
$DAI = $_SESSION["DAI"] ?? [
    [
        "id" => 1,
        "PIB" => "Brovdi Vitalii",
        "mark" => "Audi",
        "number_car" => "BB2588BA",
        "color" => "grey",
    ],
    [
        "id" => 2,
        "PIB" => "Brovdi Anton",
        "mark" => "JEEP",
        "number_car" => "AA6126ME",
        "color" => "black",
    ],
    [
        "id" => 3,
        "PIB" => "Brovdi Erika",
        "mark" => "Lexus",
        "number_car" => "AK9265AK",
        "color" => "blue",
    ],
    [
        "id" => 4,
        "PIB" => "Brovdi Misha",
        "mark" => "Suzuki",
        "number_car" => "AK2452HH",
        "color" => "black",
    ]
];
function getId($DAI){
    for ($i = 0;$i < count($DAI);$i++){
        if ($_GET["id"] == $DAI[$i]["id"]){
            $max = $DAI[0]["id"];
            for ($j = 0; $j < count($DAI);$j++){
                if ($DAI[$j]["id"] > $max){
                    $max = $DAI[$j]["id"];
                }
            }
            $max++;
            return $max;
        }
    }
    return $_GET["id"];
}
session_start();
if ($_GET["edit"] != null){
    for ($i = 0; $i < count($DAI);$i++){
        if ($_GET["edit"] == $DAI[$i]["id"]){
            $DAI[$i] = ["id" => getId($DAI),
                "PIB"=>$_GET["PIB"],
                "mark" =>$_GET["mark"],
                "number_car" =>$_GET["number_car"],
                "color"=>$_GET["color"]];
            $_SESSION["DAI"] = $DAI;
            break;
        }
    }
}
else{
    if($_GET["id"] == null){
        $_GET["id"] = 1;
    }
    if($_GET["PIB"] == null){
        $_GET["PIB"] = "ПІБ";
    }
    if($_GET["mark"] == null){
        $_GET["mark"] ="відсутня марка";
    }
    if($_GET["number_car"] == null){
        $_GET["number_car"] = "Номер відсутній";
    }
    if($_GET["color"] == null){
        $_GET["color"] = "Невідомий колір";
    }

    $DAI[] = ["id" => getId($DAI),
        "PIB" => $_GET["PIB"],
        "mark" => $_GET["mark"],
        "number_car" => $_GET["number_car"],
        "color" => $_GET["color"]];
    $_SESSION["DAI"] = $DAI;
}
function MySample($arr,$request): array
{
    $newArray = [];
    $k = strlen($request);
    for($i = 0; $i < count($arr); $i++){
        if (substr($arr[$i]['number_car'],1,$k) == $request){
            $newArray[] = $arr[$i];
        }
    }
    return $newArray;
}
?>
<table>
    <tr>
        <?php foreach (array_keys($DAI[0]) as $key):?>
            <th> <?= $key ?></th>
        <?php endforeach;?>
    </tr>
    <?php foreach ($DAI as $car):?>
        <tr>
            <?php foreach ($car as $key=>$value):?>
                <td> <?= $value ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$arr = MySample($DAI,"AK2452");
echo "<h2> Таблиця після запиту</h2>";
echo "Запит: $request <br>";
echo "<table>";
echo "<tr> <th>Id</th> <th>PIB</th> <th>mark</th> <th>Number_car</th> <th>Color</th> </tr>";
for ($i = 0; $i < count($arr); $i++) {
    echo "<tr>";
    foreach ($arr[$i] as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>
<style>
    body{
        background: darkgray;
    }
    table   {
        border: aqua 2px solid;
    }
    td, th{
        text-align: center;
        padding: 10px;
    }
    tr:hover {background-color: coral;}
    .form_add{
        display: flex;
        padding: 10px;
    }
    .form_label{
        border: 1px green solid;
        padding: 10px;
    }
    .type_id_field, .code-class, .pib, .mark, .number, .color, .button{
        padding: 5px;
        margin: 10px;
        border: 1px solid black;
    }

</style>
<form method="GET" action="">
    <div class="form_add">
        <label class="form_label">
            <input type="number" name="edit" class="type_id_field" placeholder="Type id for edit"><br>
            Код:<input type="text" class="code-class" name="id"> <br>
            ПІБ:<input type="text" class="pib" name="PIB"> <br>
            Марка автомобіля:<input class="mark" type="text" name="mark"> <br>
            Номер:<input type="text" class="number" name="number_car"> <br>
            Колір:<input type="text" class="color" name="color"> <br>
            <input type="submit" class="button" name="btn-add" value="ADD"><br>

            Запит:<input type="hidden" name="request" value="">
        </label>
    </div>
</form>