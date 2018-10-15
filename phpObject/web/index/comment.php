<?php
$name=$_POST['name'];
$content=$_POST['content'];
$id=$_POST['id'];
$date=date("Y-m-d");
if(!$name){
    $name="游客".time();
}
include "../libs/db.php";
$sql="INSERT INTO comments(name,content,aid,date)VALUES ('{$name}','{$content}','{$id}','{$date}')";
$db->query($sql);
if($db->affected_rows===1){
    $msg="评论成功";
    $href="content.php?aid=$id";
}else{
    $msg="评论失败";
    $href="content.php?aid=$id";
}
include "../admin/message.php";