<?php
session_start();
if(!isset($_SESSION['User_Name'])){
    header('Location: index.php');
}
require_once('general.config.php');
require_once('Class.php');

print_r( $_SESSION);

//how to user insert 
/*
$blap = new sql();
$attr = ['User_Name','Password','Mail','Phone_Number','salt'];
$values = ['boerHenk','$2y$10$wgRvjL6qz1E/AGVqIYIPDuP4G7.mJepFtTaFah52nH6ctIXr.md4.','Mail@mail.mail','PhoneNumber','849592'];
$blap->insert('user',$attr,$values);
*/













$query = $db->prepare('SELECT * FROM `chat` WHERE User1_ID = :ID OR User2_ID = :ID');
$query->bindPARAM(':ID',$_SESSION['User_ID'],PDO::PARAM_INT);
$query->execute();
$Chat = $query->fetchall(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./CSS/Chat.css">
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<script src="Javascript/Chat.js"></script>
</head>
<body>
    <div id="background">
    </div>
    <div id="chat">
        <div id="chat_wrapper">
            <div id="chat_title" onclick="toggle_chat_list()">
                <label><?php echo'***Chat';?></label>
            </div>
            <div id="chats">
                <?php
                for($i=0;$i<count($Chat);$i++){
                    $query = $db->prepare('SELECT User_Name,User_ID from `user` where user_ID = ?');
                    if($_SESSION['User_ID']==$Chat[$i]['User1_ID']){
                        $query->bindPARAM(1,$Chat[$i]['User2_ID'],PDO::PARAM_INT);
                    }else{
                        $query->bindPARAM(1,$Chat[$i]['User1_ID'],PDO::PARAM_INT);
                    }
                    $query->execute();
                    $Name = $query->fetchall(PDO::FETCH_ASSOC);
                    echo'</pre><div class="chats" data-user="'.$Chat[$i]['Chat_ID'].'" onclick="ShowChatLog(this)"><label>'.$Name[0]['User_Name'].'<label></div>';
                }?>
            </div>
            <div id="ChatCheck">
            </div>
            <div id="ChatLogCheck">
            </div>
            <div id="ChatLog">
            </div>
            <div id='TypBar'><input type='text' id='chatInput' /><div onclick='SendText()' id='Send'><?PHP echo '***Send';?></div></div>
        </div>
    </div>
    <div id="bottom">
    </div>
</body>
<script>
    ThisUser = <?PHP echo $_SESSION['User_ID']; ?>;
</script>