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

function defaultDataDAI(): array
{
    return [
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
}

function CreateNewCar($array, $id): array
{
    return [
        'id' => $id,
        'PIB' => $array['PIB'],
        'mark' => $array['mark'],
        'number_car' => $array['number_car'],
        'color' => $array['color'],
    ];
}

function validationDataCars($array): bool
{
    return !(
        empty($array['PIB']) ||
        empty($array['mark']) ||
        empty($array['number_car']) ||
        empty($array['color']) ||
        !isset($array)
    );
}
function MySample($arr,$request): array
{
    $newArray = [];
    $k = strlen($request);
    for($i = 0; $i < count($arr); $i++){
        if (substr($arr[$i]['number_car'],0,$k) == $request){
            $newArray[] = $arr[$i];
        }
    }
    return $newArray;
}
function displayTableCars($array)
{
    $table = '<table>';
    $table .= '<tr> <th>id</th> <th>PIB</th> <th>mark</th> <th>number_car</th> <th>color</th></tr>';

    foreach ($array as $item) {
        $table .= "<tr>" .
            "<td>$item[id]</td><td>$item[PIB]</td><td>$item[mark]</td>" .
            "<td>$item[number_car]</td><td>$item[color]</td>" .
            "</tr>";
    }

    $table .= '</table>';
    echo $table;
}

session_start();

$request = $_POST['request'];
if (empty($_SESSION)) {
    $_SESSION['Cars'] = defaultDataDAI();
}
$action = $_POST['action'];
// add
if ($action == 'add'){
    if (validationDataCars($_POST)) {
        $nextCarId = count($_SESSION['Cars']) + 1;
        $_SESSION['Cars'][] = CreateNewCar($_POST, $nextCarId);
    }
}

// edit
elseif ($action == 'edit'){
    if (validationDataCars($_POST)) {
        $idToEdit = $_POST['id'];
        foreach ($_SESSION['Cars'] as $key => $value) {
            if ($value['id'] == $idToEdit) {
                $_SESSION['Cars'][$key] = CreateNewCar($_POST, $idToEdit);
                break;
            }
        }
    }
}
elseif ($action == 'savefile') {
    $file = fopen("cars.txt", "w");
    fwrite($file, serialize($_SESSION['Cars']));
    fclose($file);
} // loading data from clients.txt
elseif ($action == 'loadfile') {
    $_SESSION['Cars'] = unserialize(file_get_contents("cars.txt"));
}
// filter
elseif ($action == 'filter'){
    $arr = MySample($_SESSION['Cars'], $_POST['request']);
}
// table all Cars
displayTableCars($_SESSION['Cars']);
// filter table
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
unset($_POST);
?>
<br>

<button onclick="ShowAddForm()"> ADD </button>
<button onclick="ShowEditForm()"> EDIT </button>
<button onclick="ShowFilterForm()"> FILTER </button>

<br>
<form action='<?= $_SERVER['PHP_SELF']?>' method='post' id='addForm'>
    ADD <br>
    <label> PIB:
        <input type='text' name='PIB'>
    </label><br>
    <label> mark:
        <input type='text' name='mark'>
    </label><br>
    <label> number_car:
        <input type='text' name='number_car'>
    </label><br>
    <label> color:
        <input type='text' name='color'>
    </label><br>
    <input type='hidden' name='action' value='add'>
    <input type='submit'>
</form>

<br>
<form action='<?= $_SERVER['PHP_SELF']?>' method='post' id='editForm'>
    EDIT <br>
    <label> id:
        <input type='number' name='id'>
    </label><br>
    <label> PIB:
        <input type='text' name='PIB'>
    </label><br>
    <label> mark:
        <input type='text' name='mark'>
    </label><br>
    <label> number_car:
        <input type='text' name='number_car'>
    </label><br>
    <label> color:
        <input type='text' name='color'>
    </label><br>
    <input type='hidden' name='action' value='edit'>
    <input type='submit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF']?>' method='post' id='filterForm'>
    Filter <br>
    <label> request:
        <input type='text' name='request'>
    </label><br>
    <input type='hidden' name='action' value='filter'>
    <input type='submit'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='savefile'>
    <input type='hidden' name='action' value='savefile'>
    <input type='submit' value='Save to file'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='loadfile'>
    <input type='hidden' name='action' value='loadfile'>
    <input type='submit' value='Upload from file'>
</form>

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
</style>
<script>
    function ShowAddForm() {
        document.querySelector('#addForm').style.display = 'inline';
    }
    function ShowEditForm() {
        document.querySelector('#editForm').style.display = 'inline';
    }
    function ShowFilterForm() {
        document.querySelector('#filterForm').style.display = 'inline';
    }
</script>