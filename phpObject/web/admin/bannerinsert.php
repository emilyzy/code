<?php
$sort=$_POST["sort"];
$src=$_POST["src"];
include "../libs/db.php";
$sql="INSERT INTO banner(src,sort)VALUES ('{$src}','{$sort}')";
$db->query($sql);
if($db->affected_rows===1){
    $msg="添加成功";
    $href="bannerlist.php";
}else{
    $msg="添加失败";
    $href="banneradd.php";
}
include "message.php";
