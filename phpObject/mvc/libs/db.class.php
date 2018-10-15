<?php

/**
 * Created by PhpStorm.
 * User: emily
 * Date: 18-10-8
 * Time: 下午3:27
 */
class db
{
    public $host="localhost";
    public $user="root";
    public $pass="123";
    public $db="mvc";
    public $table="";
    public $con="";
    public function __construct($table)
    {
        $this->table=$table;
        $this->con=new mysqli($this->host,$this->user,$this->pass,$this->db);
    }
    function selectAll($fields="*",$where="1"){
        $sql="SELECT $fields FROM ".$this->table." WHERE $where";
        $r=$this->con->query($sql);
        $result=$r->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    function selectOne($where,$fields="*"){
        $sql="SELECT $fields FROM ".$this->table." WHERE $where";
        $r=$this->con->query($sql);
        $result=$r->fetch_assoc();
        return $result;
    }
    function delete($where){
        $sql="DELETE FROM ".$this->table." WHERE $where";
        $this->con->query($sql);
        return $this->con->affected_rows;
    }
    function insert($arr){
        $keys="";
        $vals="";
        foreach ($arr as $k=>$v){
            $keys.="`".$k."`,";
            $vals.="'".$v."',";
        }
        $len=strlen($keys);
        $keys=substr($keys,0,$len-1);
        $len=strlen($vals);
        $vals=substr($vals,0,$len-1);
        $sql="INSERT INTO ".$this->table."($keys) VALUES($vals)";
        echo $sql;
        $this->con->query($sql);
        return $this->con->affected_rows;
    }
    function update($field,$where){
        $sql="UPDATE ".$this->table." SET $field WHERE $where";
        $this->con->query($sql);
        return $this->con->affected_rows;
    }
    function close(){
        $this->con->close();
    }
}

















