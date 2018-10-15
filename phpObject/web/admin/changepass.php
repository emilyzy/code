<?php
$mpass=$_POST["mpass"];
include "../libs/db.php";
$sql="SELECT * FROM admin";
$r=$db->query($sql);
$r=$r->fetch_assoc();
if($r["password"]!==$mpass){
    $msg="原始密码错误";
    $href="pass.php";
    include "message.php";
    exit();
}
$newpass=$_POST["newpass"];
$sql="UPDATE admin SET password='{$newpass}'";
$db->query($sql);
if($db->affected_rows===1){
    $msg="修改成功";
    $href="pass.php";
}else{
    $msg="修改失败";
    $href="pass.php";
}
include "message.php";