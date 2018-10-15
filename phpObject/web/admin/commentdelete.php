<?php
$id=$_GET["id"];
include "../libs/db.php";
$sql="DELETE FROM comments WHERE id=$id";
$db->query($sql);
if($db->affected_rows===1){
    $msg="删除成功";
    $href="commentlist.php";
}else{
    $msg="删除失败";
    $href="commentlist.php";
}
include "message.php";