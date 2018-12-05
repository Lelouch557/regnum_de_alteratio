<?php
session_start();
if(!isset($_SESSION['User_Name'])){
    header('Location: index.php');
}
require_once('general.config.php');
$query = $db->prepare('SELECT Count(*) as count FROM `messages` where reciever=? AND seen=0');
$query->bindPARAM(1,$_SESSION['User_Name'],PDO::PARAM_INT);
$query->execute();
$Messages = $query->fetchall(PDO::FETCH_ASSOC);
$Message=false;
if($Messages[0]['count']>0){
    $Message=true;
}

$query = $db->prepare('SELECT * FROM `report` where User_ID_Victor=:ID OR User_ID_Lost=:ID');
$query->bindPARAM(':ID',$_SESSION['User_Name'],PDO::PARAM_INT);
$query->execute();
$Reports = $query->fetchall(PDO::FETCH_ASSOC);
$Report=false;
for($i=0;count($Reports)>$i;$i++){
    if(!$Report){
        if($Reports[$i]['User_ID_Victor']==$_SESSION['User_Name']){
			$VictorLoser = 'SeenVictor';
		}else{
			$VictorLoser = 'SeenLoser';
		}
        if(!isset($Reports)){
            $Report=true;
        }
    }else{
        $i=count($Reports)+1;
    }
}

$header='
    <div id="Links">
        <div class="LeftIcons">
            <a   class="iconsA" href="home.php">
                <img onhover="Hover()" src="./Images/Village.png">
                </img>  
            </a>
        </div>
        <div class="LeftIcons">
            <a   class="iconsA" href="Research.php">
                <img onhover="Hover()" src="./Images/ResearchIcon.png">
                </img>  
            </a>
        </div>
        <div class="LeftIcons">
            <a   class="iconsA" href="City_Hall.php">
                <img onhover="Hover()" src="./Images/City_Hall_Icon.png">
                </img>  
            </a>
        </div>
        <div class="LeftIcons">
            <a   class="iconsA" href="Rekruting.php">
                <img onhover="Hover()" src="./Images/HammerAndAnvil.png">
                </img>
            </a>
        </div>
        <div class="LeftIcons">
            <a   class="iconsA" href="#">
                <img onhover="Hover()" src="./Images/Points.png" style="height:200%">
                </img>
            </a>
        </div>
        <div class="LeftIcons">
            <a href="Map.php"  class="iconsA" >
                <img onhover="Hover()" src="./Images/nesw.png">
                </img>
            </a>
        </div>
        <div class="LeftIcons">
            <a href="messages.php"  class="iconsA" >
                <img onhover="Hover()" src="./Images/'; if($Message){$header.="New";}$header.='Message.png">
                </img>
            </a>
        </div>
        <div class="LeftIcons">
            <a href="reports.php"  class="iconsA">
                <img onhover="Hover()" src="./Images/'; if($Report){$header.="New";}$header.='Report.png">
                </img>
            </a>
        </div> 
        <div class="LeftIcons">
            <a href="Settings.php"  class="iconsA">
                <img onhover="Hover()" src="./Images/Gear.png">
                </img>
            </a>
        </div>
    </div>
';
?>