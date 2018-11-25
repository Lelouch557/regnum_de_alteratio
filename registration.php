<!DOCTYPE html>
<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
</head>
<body>
    <form action="registration_save.php" method="post">
        <input id="User_Name" name="User_Name" type="text"/>
        <input id="Password1" name="Password1" type="Password"/>
        <input id="Password2" name="Password2" type="Password"/>
        <input id="Mail" name="Mail" type="text"/>
        <input type="button" onclick="send()" value="***    Submit"/>
    </form>
<script>
    function send(){
        bool = true;
        pass = true;
        function check(string){
            id = '#'+string;
            val = $(id).val();
            console.log(id);
            if(val.length < 6){
                $(id).css('box-shadow','0px 0px 10px 0px red');
                bool = false;
            }
        }
        var User_name = $('#User_Name').val();
        var Password1 = $('#Password1').val();
        var Password2 = $('#Password2').val();
        var Mail = $('#Mail').val();

        check('User_Name');
        check('Mail');
        if(Password1 != Password2){
            $('#Password1').css('box-shadow','0px 0px 10px 0px red');
            $('#Password2').css('box-shadow','0px 0px 10px 0px red');
            bool = false;
            pass = false;
        }else{
            $('#Password1').css('box-shadow','0px 0px 0px 0px red');
            $('#Password2').css('box-shadow','0px 0px 0px 0px red');
            pass = true;
        }
        if(pass){
            check('Password1');
        }
        if(bool){
            $.post('registration_save.php',{
                User_name: User_name,
                Password1: Password1,
                Password2: Password2,
                Mail: Mail
            },(data)=>{
                if(data == '1'){
                    window.location.href = 'home.php';
                }
                alert(data);
            });
        }
    }
</script>
</body>