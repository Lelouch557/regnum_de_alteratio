<?PHP
include_once('../general.config.php');
if(isset($_COOKIE['Language'])){
  REQUIRE_ONCE('../Language/'.$_COOKIE['Language'].'/Global.php');
}else{
  REQUIRE_ONCE('../Language/ENG/Global.php');
}
if(trim($_POST['c2']) != ''){
    $query = $db->prepare('INSERT INTO chat_message (Chat_ID,User_ID,Message) values(?,?,?)');
    $query->bindParam(1,$_POST['c1'],PDO::PARAM_INT);
    $query->bindParam(2,$_POST['c3'],PDO::PARAM_INT);
    $query->bindParam(3,$_POST['c2'],PDO::PARAM_STR);
    $query->execute();
}
return;
?>