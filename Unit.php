<?php
class Units{
    private $db;
    function __construct() {
        include 'general.config.php';
        $this->db = $db;
    }
    function get_Units(){
        $this->db->query('select * from unit where');
    }
    function train(){
        $this->db->query('select *');
    }
}