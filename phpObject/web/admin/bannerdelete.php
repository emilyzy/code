<?php
$id=$_GET["id"];
include "../libs/db.php";
$sql="DELETE FROM banner WHERE id=$id";
$db->query($sql);
if($db->affected_rows===1){
    $msg="删除成功";
    $href="bannerlist.php";
}else{
    $msg="删除失败";
    $href="bannerlist.php";
}
include "message.php";