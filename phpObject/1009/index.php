<?php
include "libs/Smarty.class.php";
$smarty=new Smarty();
$smarty->setTemplateDir("./template");
$smarty->setCompileDir("./compile");
$smarty->display("index.html");//编译某个模板并输出
?>
//VID20181009090452
