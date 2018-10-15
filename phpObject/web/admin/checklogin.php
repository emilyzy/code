<?php
$username=$_POST["username"];
$password=$_POST["password"];
$code=$_POST["code"];
session_start();
if(strtoupper($code)!==strtoupper($_SESSION["code"])){
    $msg="验证码错误";
    $href="login.php";
    include ("message.php");
    exit();
}
include "../libs/db.php";
$sql="SELECT * FROM admin WHERE username='$username'";
$r=$db->query($sql);//对象
$res=$r->fetch_assoc();//转换成数组

if($res){
    if($password===$res["password"]){
        $_SESSION["login"]=$res["username"];
        include ("admin.php");
        $msg="登录成功";
        $href="admin.php";
    }else{
        $msg="密码错误";
        $href="login.php";
    }
}else{
    $msg="用户名不存在";
    $href="login.php";
}
include "message.php";
