<?php
require_once('general.config.php');
require_once('Class.php');
require_once('Login_class.php');

if($_POST['Password1'] != $_POST['Password2']){
    echo'PASS != SAME'.$_POST['Password1'].$_POST['Password2'];
    die();
}
$pass = true;
$sql = new sql();
$login = new User();
$attr = [];
$values = [];
foreach($_POST as $key => $value){
    if(!preg_match('/[0-9a-zA-Z]/',$key)){
        echo'01';
        die();
    }
    if(preg_match('/[<>]/',$value)){
        echo'02';
        die();
    }
    if(strlen($value) < 6){
        echo'03';
        die();
    }
    
    if(strpos($key, 'Password') > -1){
        if($pass){
            $pass = false;
            array_push($attr, 'Password');
            array_push($values, password_hash(htmlspecialchars(trim($value)),PASSWORD_DEFAULT));
        }
    }else{
        array_push($attr, $key);
        array_push($values, htmlspecialchars(trim($value)));
    }
}
array_push($attr,'salt');
array_push($values,rand(100000000, 1000000000));

if(!$login->duplication($values[0])){
    $sql->insert('user',$attr,$values);
    $login->Login(htmlspecialchars(trim($values[0])),htmlspecialchars(trim($_POST['Password1'])));
    echo'1';
else{
    echo'0';
}
?>