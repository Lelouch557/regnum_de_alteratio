<?php
session_start();
if(!isset($_SESSION['User_Name'])){
    header('Location: index.php');
}
require_once('general.config.php');

?>
<!DOCTYPE html>
<body>
<form class="" action="dash_insert.php" method="post">
    <select name="table">
        <option>tech</option>
        <option>unit</option>
        <option>building</option>
        <option>user</option>
    </select>
    <input name="User_name" type="User_name">
    <input name="Password" type="Password">
    <input name="Mail" type="Mail">
    <input type="submit"/>
</form>
</body>