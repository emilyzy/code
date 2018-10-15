<?php
$id=$_POST["id"];
$sort=$_POST["sort"];
$typename=$_POST["typename"];
include "../libs/db.php";
$sql="UPDATE type SET sort='{$sort}' ,typename='{$typename}' WHERE id=$id";
$db->query($sql);
if($db->affected_rows===1){
    $msg="更新成功";
    $href="typelist.php";
}else{
    $msg="更新失败";
    $href="typeedit.php?id=$id";
}
include "message.php";
