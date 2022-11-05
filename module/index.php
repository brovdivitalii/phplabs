<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
if (!isset($_SESSION)) {
    session_start();
}
include 'DBconnector.php';
$newRepo = new DBCntr(dbcntr);
echo Show::showStud($newRepo->read());
if (empty($_SESSION['Students'])) {
    $_SESSION['Students'] = new StudentsCollection();
    $_SESSION['Students']->defaultStud();
}

echo Show::showStud($_SESSION['Students']->students)
?>
<select Name='NEW'>
    <option value="">--- Select ---</option>
    <?php
    $stud = $_SESSION['Students']->filter();
    foreach($stud as $item){
    echo "<option value='strtolower($item)'>$item</option>";    }?>
</select>
