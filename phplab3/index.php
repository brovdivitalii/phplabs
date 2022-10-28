<?php

function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}

spl_autoload_register('myAutoloader');
if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['Cars'])) {
    $_SESSION['Cars'] = new CarsCollection();
    $_SESSION['Cars']->defaultCars();
}

$action = $_POST['action'];

if ($action == 'add') {
    if (DAI::validationDataCars($_POST)) {
        $_SESSION['Cars']->addCar(
            new DAI(5, $_POST)
        );
    }
} elseif ($action == 'edit') {
    if (DAI::validationDataCars($_POST)) {
        $_SESSION['Cars']->editCar(
            $_POST
        );
    }
} elseif ($action == 'filter') {
    echo $_SESSION['Cars']->displayFilteredCars($_POST['request']);
} elseif ($action == 'savefile') {
    $_SESSION['Cars']->saveCars();
} elseif ($action == 'loadfile') {
    $_SESSION['Cars']->loadCars();
}

echo $_SESSION['Cars']->displayCars();
?>
<br>

<button onclick="ShowAddForm()"> ADD</button>
<button onclick="ShowEditForm()"> EDIT</button>
<button onclick="ShowFilterForm()"> FILTER</button>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='addForm'>
    ADD <br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> phone:
        <input type='text' name='phone'>
    </label><br>
    <label> address:
        <input type='text' name='address'>
    </label><br>
    <label> time:
        <input type='number' name='time'>
    </label><br>
    <label> bill:
        <input type='number' name='bill'>
    </label><br>
    <input type='hidden' name='action' value='add'>
    <input type='submit' value='add'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='addForm'>
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
<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='editForm'>
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

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='filterForm'>
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
    body {
        background: darkgray;
    }

    table {
        border: aqua 2px solid;
    }

    td, th {
        text-align: center;
        padding: 10px;
    }

    tr:hover {
        background-color: coral;
    }
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