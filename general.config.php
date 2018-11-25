<?php
//localhost
$user = 'iabamun_admin';
$pass = 'hsSzJSNjGIVWRMS9';
$host = 'localhost';
$dbname = 'iabamun';

$db = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>