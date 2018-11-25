<?PHP
include_once('../general.config.php');
if(isset($_COOKIE['Language'])){
  REQUIRE_ONCE('../Language/'.$_COOKIE['Language'].'/Global.php');
}else{
  REQUIRE_ONCE('../Language/ENG/Global.php');
}
$query = $db->prepare("SELECT * FROM chat_message where Chat_ID=:ID");
$query->bindparam(':ID',$_POST['c1'],PDO::PARAM_INT);
$query->execute();
$result = $query->fetchall(PDO::FETCH_ASSOC);
$log = '';
if(isset($result)){
    for($i=0;$i<count($result);$i++){
        $log .= '<div class="';
        if($result[$i]['User_ID'] == $_POST['c2']){
            $log .= "this_person";
        }else{
            $log .= "other_person";
        }
        $log .= '">'.$result[$i]['Message'].'</div>';
    }
}else{
    print_r($result);
}
print_r($log);
return ;
?>