<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/25
 * Time: 16:54
 */
$title=$_POST["title"];
$thumb=$_POST["thumb"];
$date=$_POST["date"];
$tid=$_POST["tid"];
$content=$_POST["content"];
include "../libs/db.php";
$sql="INSERT INTO article(title,thumb,date,tid,content)VALUES('{$title}','{$thumb}','{$date}','{$tid}','{$content}')";
$db->query($sql);
if($db->affected_rows===1){
    $msg="添加成功";
    $href="articlelist.php";
}else{
    $msg="添加失败";
    $href="articleadd.php";
}
include "message.php";