<?php
if(isset($_COOKIE['Language'])){
  REQUIRE_ONCE('./Language/'.$_COOKIE['Language'].'/Global.php');
}else{
  REQUIRE_ONCE('./Language/ENG/Global.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<title><?PHP echo 'IABAMUN'?></title>
	<link  rel="stylesheet" type="text/css" href="./CSS/Login.css">
</head>
<body>
	<div id="LoginDiv">
		<div id="LoginWrap">
 			<form id='FORM' autocomplete="off" action="Login.php" method="POST">
   			 	<table>
    		  		<tr>
    		    		<td>
    		      			<input name='User_Name' onfocus='' required autocomplete='off' type="text" placeholder='<?PHP echo '***User_Name'  ?>' id="User_Name"/>
    		    		</td>
    		  		</tr>
    		  		<tr>
    		    		<td>
    		      			<input name='Password' onfocus='' required autocomplete='off' type="password" placeholder='<?PHP echo '***Password'  ?>' id="Password"/>
    		    		</td>
    		  		</tr>
    		  		<tr>
    		    		<td colspan='2'>
    		      			<input type="button" id='button'onclick='Inlog()' value="<?PHP echo 'Login' ?>"/>
    		    		</td>
    		  		</tr>
    			</table>
  			</form>
		</div>
	</div>
</body>
<script>
		$SavedName = '';
		Messages = [];
		Messages[1] = 'VALI2';
		Messages['User_Name'] = '<?=  '***User_Name' ?>';
		Messages['Password'] = '<?=  '***Password' ?>';
		function Inlog(){
			$USR_N = $('#User_Name').val();
			$Pass = $('#Password').val();
			if($USR_N == '' || $Pass == ''){
			console.log('g');
				if(!$USR_N){
					$('#User_Name').attr('class','invalid');
					$('#User_Name').attr('placeholder',Messages[1]);
					$('#User_Name').attr('onfocus','Revert("User_Name")');
					
				}
				if(!$Pass){
					$('#Password').attr('class','invalid');
					$('#Password').attr('placeholder',Messages[1]);
					$('#Password').attr('onfocus','Revert("Password")');
				}
			}else{
				$.post('login.php',{name:$USR_N,pass:$Pass},function(data){
					if(data == '1'){
						window.location.href = 'home.php';
					}else{
						console.log(data);
					}
				});
			}
		}
		$(document).keypress(function(e){
			if(e.which == 13){
				Inlog();
			}
		});
		function Revert(data){
			id = '#'+data;
			$(id).attr('onfocus','');
			$(id).attr('class','no');
			if(id=='#User_Name'){$(id).val($SavedName);}
			$(id).attr('placeholder',Messages[data]);
		}
  	</script>
</html>

