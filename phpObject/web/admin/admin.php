<?php
session_start();
if(!isset($_SESSION["login"])){
    $msg="请先登录";
    $href="login.php";
    include "message.php";
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>
    <link rel="stylesheet" href="../static/css/pintuer.css">
    <link rel="stylesheet" href="../static/css/admin.css">
    <script src="../static/js/jquery.js"></script>
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
    <div class="logo margin-big-left fadein-top">
        <h1><img src="../static/images/y.jpg" class="radius-circle rotate-hover" height="50" alt="" />后台管理中心</h1>
    </div>
    <div class="head-l"><a class="button button-little bg-green" href="../index/index.php" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;<a href="##" class="button button-little bg-blue"><span class="icon-wrench"></span> 清除缓存</a> &nbsp;&nbsp;<a class="button button-little bg-red" href="logout.php"><span class="icon-power-off"></span> 退出登录</a> </div>
</div>
<div class="leftnav">
    <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
    <h2><span class="icon-user"></span>基本设置</h2>
    <ul style="display:block">
        <li><a href="pass.php" target="right"><span class="icon-caret-right"></span>修改密码</a></li>
        <li><a href="bannerlist.php" target="right"><span class="icon-caret-right"></span>轮播管理</a></li>
        <li><a href="typelist.php" target="right"><span class="icon-caret-right"></span>分类管理</a></li>
        <li><a href="articlelist.php" target="right"><span class="icon-caret-right"></span>文章管理</a></li>
        <li><a href="commentlist.php" target="right"><span class="icon-caret-right"></span>评论管理</a></li>
    </ul>
</div>
<script type="text/javascript">
    $(function(){
        $(".leftnav h2").click(function(){
            $(this).next().slideToggle(200);
            $(this).toggleClass("on");
        })
        $(".leftnav ul li a").click(function(){
            $("#a_leader_txt").text($(this).text());
            $(".leftnav ul li a").removeClass("on");
            $(this).addClass("on");
        })
    });
</script>
<ul class="bread">
    <li><a href="{:U('Index/info')}" target="right" class="icon-home"> 首页</a></li>

</ul>
<div class="admin">
    <iframe scrolling="auto" rameborder="0" src="pass.php" name="right" width="100%" height="100%"></iframe>
</div>

</body>
</html>