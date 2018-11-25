<?php
session_start();
require_once('Login_class.php');
$checked = new User;
if($checked->duplication($_POST['name'])){
    if($checked->login($_POST['name'],$_POST['pass'])){
        echo'1';
    }else{
        echo'01';
    }
}else{
    echo '10';
}