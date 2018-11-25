<?php
class sql {
    private $db;

    function __construct() {
        include 'general.config.php';
        $this->db = $db;
    }


    function insert($table,$attr,$values){
        $sql = "INSERT INTO $table (";
        for($i=0;$i<count($attr);$i++){
            $sql.=$attr[$i];
            if(($i+1)!=count($attr)){
                $sql.=',';
            }
        }
        $sql.=') VALUES(';
        for($i=0;$i<count($values);$i++){
            $sql.='?';
            if(($i+1)!=count($values)){
                $sql.=',';
            }
        }
        $sql.=')';

        $query = $this->db->prepare($sql);
        for($i=1;$i<=count($values);$i++){
            $int = $i-1;
            if(is_int($values[$int])){
                $query->bindparam($i,$values[$int],PDO::PARAM_INT);
            }else{
                $query->bindparam($i,$values[$int],PDO::PARAM_STR);
            }
        }
        $query->execute();
        
        $return = [true];
        return $return;
    }
    
    function check(){
        $args = func_get_args();
        $preg = '/[';
        $preg2 = '/[^0-9a-zA-Z]/';

        $args[$i] = htmlspecialchars(trim(func_get_arg(0)));
        if($args[0] == ''){
            return false;
        }
        if(strpos($args[1],'NUMBER')=='TRUE'){
            $preg.='0-9';
        }
        if(strpos($args[1],'SMALL_LETTER')=='TRUE'){
            $preg.='a-z';
        }
        if(strpos($args[1],'LARGE_LETTER')=='TRUE'){
            $preg.='A-Z';
        }
    
        $preg .= ']/';
        if(preg_match($preg,$args[0]) && !preg_match($preg2,$args[0])){
            $return = [true,$args[0]];
            return true;
        }else{
            return false;
        }
    }


}