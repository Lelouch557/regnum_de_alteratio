<?php
class User{
    private $db;

    function __construct() {
        include 'general.config.php';
        $this->db = $db;
    }

    function duplication($name){
        $query = $this->db->prepare('select COUNT(*) as `num` from user where User_Name = ?');
        $query->bindparam(1,$name,PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        if($result[0]['num'] > 0){
            return true;
        }else{
            return false;
        }
    }

    function check(){
        $args = func_get_args();
        for($i=0; $i<count($args); $i++){
            $temp_string = htmlspecialchars(trim(func_get_arg($i)));
            if(preg_match('/[a-z]/',$temp_string) && preg_match('/[A-Z]/',$temp_string) && preg_match('/[0-9]/',$temp_string) && !preg_match('/[^a-zA-Z0-9]/',$temp_string)){
                return'1';
            }else{
                return'0';
            }
        }
    }
    
    function login($name,$pass){
        $query = $this->db->prepare('select User_ID, password from user where User_Name = ?');
        $query->bindparam(1,$name,PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        if(count($result) > 0){
            if(password_verify($pass, $result[0]['password'])){
                $_SESSION["User_Name"] = $name;
                $_SESSION["User_ID"] = $result[0]['User_ID'];
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
?>