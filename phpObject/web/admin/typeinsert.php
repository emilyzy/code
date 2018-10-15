<?php
$sort=$_POST["sort"];
$typename=$_POST["typename"];
include "../libs/db.php";
$sql="INSERT INTO type(typename,sort)VALUES ('{$typename}','{$sort}')";
$db->query($sql);
if($db->affected_rows===1){
    $msg="添加成功";
    $href="typelist.php";
}else{
    $msg="添加失败";
    $href="typeadd.php";
}
include "message.php";
