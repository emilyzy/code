<?php
$id=$_POST["id"];
$sort=$_POST["sort"];
$src=$_POST["src"];
include "../libs/db.php";
$sql="UPDATE banner SET sort='{$sort}' ,src='{$src}' WHERE id=$id";
$db->query($sql);
if($db->affected_rows===1){
    $msg="更新成功";
    $href="bannerlist.php";
}else{
    $msg="更新失败";
    $href="banneredit.php?id=$id";
}
include "message.php";
