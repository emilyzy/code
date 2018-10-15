<?php

/**
 * Created by PhpStorm.
 * User: emily
 * Date: 18-10-9
 * Time: 上午8:40
 */
class indexModel
{
    function __construct()
    {
        $this->db=new db("user");
    }

    /*function getData(){
        $data1=$this->db->selectAll();
        $this->db->table="teacher";
        $data2=$this->db->selectAll();
        return[$data1,$data2];
    }*/
    function checkname($name){
        $r=$this->db->selectOne("username='$name'");
        $this->db->close();
        if($r){
            return "1";
        }else{
            return "0";
        }
    }
    function insert($name,$pass){
        $r=$this->db->insert(['username'=>$name,'password'=>md5($pass)]);
        $this->db->close();
        return $r;
    }
    function checklogin($name){
        $r=$this->db->selectOne("username='$name'");
        $this->db->close();
        return $r;
    }
}