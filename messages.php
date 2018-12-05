<?php
session_start();
if(!isset($_SESSION['User_Name'])){
    header('Location: index.php');
}
require_once('general.config.php');
require_once('header.php');

$query = $db->prepare('Select User_Name, TimeStamp, subject, seen from messages inner join `user` on sender = user.User_ID where `reciever`= 1 ORDER BY seen, TimeStamp');
$query->bindPARAM(1,$_SESSION['User_ID'],PDO::PARAM_INT);
$query->execute();
$messages = $query->fetchAll(PDO::FETCH_ASSOC);

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
        <link  rel="stylesheet" type="text/css" href="./CSS/Header.css">
        <link  rel="stylesheet" type="text/css" href="./CSS/messages.css">
        <script src="Javascript/Chat.js"></script>
    </head>
    <body>
        <?= $header; ?>
        <div id="table">
            <table>
                <tr>
                    <th>Sender***</th>
                    <th>Date***</th>
                    <th>Title**</th>
                    <th>Seen***</th>
                </tr>
                <?
                foreach($messages as $row){
                    echo '<tr>';
                    foreach($row as $key => $col){
                        if($key != 'seen'){
                            if($key == 'TimeStamp'){
                                echo'<td>'.date('d/m/Y',$col).'</td>';
                            }else{
                                echo'<td>'.$col.'</td>';
                            }
                        }else{
                            if($col == 1){
                                echo '<td style="background-color:yellow"></td>';
                            }else{
                                echo '<td style="background-color:grey"></td>';
                            }
                        }
                    }
                    echo '</tr>';
                }
                ?>
            </table>
        <div>
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
