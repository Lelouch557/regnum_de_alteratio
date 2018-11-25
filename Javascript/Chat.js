active = false; 
old = '';
function S1(){
    if(($("#ChatLog")[0].scrollHeight - $("#ChatLog").scrollTop()-100) <= $("#ChatLog").outerHeight()){
        Bottom = true;
    }else{
        Bottom = false;
    }
    UserID = $(ID).attr("data-user");
    $.post("./Chat/Get_Chat_Log.php",
        {c1:UserID,
        c2:ThisUser},
        function(data){
            if(data==1){
            }else{
                $('#ChatLog').html(data);
            }
        }
    );
    if(Bottom){
        $("#ChatLog").scrollTop(99999999999);
    }
}
function ShowChatLog(TID){
    if($(TID).hasClass("selected")){
        $('#chats').animate({right:"0px"});
        $(old).removeClass('selected');
        $(TID).removeClass('selected');
    }else{
        $('#chats').animate({right:"450px"});
        $(old).removeClass('selected');
        $(TID).addClass('selected');
    }
    ID = TID;
    if(active){
        clearInterval(blapi);
    }
    S1();
    blapi = setInterval(function(){
        S1();
    },1500);
    setTimeout( function(){$("#ChatLog").scrollTop(99999999999);},100);
    active = true;
    old = TID;
}
function SendText(){
    chatInput = $('#chatInput').val();
    if(chatInput != ''){
        console.log(UserID);
        console.log(chatInput);
        console.log(ThisUser);
        $.post("./Chat/SendText.php",
            {c1:UserID,
            c2:chatInput,
            c3:ThisUser},
            function(data){
                S1();
            }
        );
        $('#chatInput').val('');
    }
}
$('#chatInput').keypress(function(e) {
    if(e.which == 13) {
        SendText();
    }
});
function toggle_chat_list(){
    if($('#ChatCheck').css('display')=='none'){
        $('#chat').animate({bottom:"0px"},400);
        $('#ChatCheck').css("display","block");
    }else{
        $('#chat').animate({bottom:"-369px"},400);
        $('#ChatCheck').css("display","none");
    }
}