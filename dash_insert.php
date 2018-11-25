<?php

session_start();
if(!isset($_SESSION['User_Name'])){
    header('Location: index.php');
}
require_once('general.config.php');
require_once('Class.php');

$attr = [];
$values = [];
foreach($_POST as $key => $value){
    array_push($attr, $key);
    if($key == 'Password'){
        array_push($values, password_hash($value,PASSWORD_DEFAULT));
    }else{
        array_push($values, $value);
    }
}
array_shift($attr);
array_shift($values);
array_push($attr,'salt');
array_push($values,rand(100000000, 1000000000));

$blap = new sql();
$result = $blap->insert($_POST['table'],$attr,$values);
print_r($result);

?>