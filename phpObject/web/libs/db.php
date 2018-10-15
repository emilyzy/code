<?php
header("Content-Type:text/html;charset=utf-8");
$db=new mysqli("localhost","root","123","blog");
if($db->connect_errno){
    echo "数据库连接失败<br>"+$db->connect_error;
    exit();
}
$db->query("SET NAMES UTF8");