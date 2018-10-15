<?php
include_once "../libs/db.php";
$sql="SELECT * FROM type ORDER BY sort";
$r=$db->query($sql);
$types=$r->fetch_all(MYSQLI_ASSOC);
?>
<header>
    <div class="hidden-xs header"><!--超小屏幕不显示-->
        <h1 class="logo"> <a href="index.php" title="个人技术博客"></a> </h1>
        <ul class="nav hidden-xs-nav">
            <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>网站首页</a></li>
            <li class="active"><a href="../admin/login.php"><span class="glyphicon glyphicon-file"></span>添加文章</a></li>
            <li class="active"><a href="http://www.w3school.com.cn/"><span class="glyphicon glyphicon-time"></span>日常学习</a></li>
            <?php foreach($types as $v):?>
                <li><a href="list.php?tid=<?php echo $v['id']?>&typename=<?php echo $v['typename']?>"><span class="glyphicon glyphicon-erase"></span><?php echo $v['typename']?></a></li>
            <?php endforeach;?>
        </ul>
    </div>
    <!--/超小屏幕不显示-->
    <div class="visible-xs header-xs"><!--超小屏幕可见-->
        <div class="navbar-header header-xs-logo">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-xs-menu" aria-expanded="false" aria-controls="navbar"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
        </div>
        <div id="header-xs-menu" class="navbar-collapse collapse">
            <ul class="nav navbar-nav header-xs-nav">
                <li class="active"><a href="index.html"><span class="glyphicon glyphicon-home"></span>网站首页</a></li>
                <?php foreach($types as $v):?>
                    <li><a href="list.php?tid=<?php echo $v['id']?>&typename=<?php echo $v['typename']?>"><span class="glyphicon glyphicon-erase"></span><?php echo $v['typename']?></a></li>
                <?php endforeach;?>
            </ul>
            <form class="navbar-form" action="search.php" method="post" style="padding:0 25px;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="请输入关键字">
                    <span class="input-group-btn">
            <button class="btn btn-default btn-search" type="submit">搜索</button>
            </span> </div>
            </form>
        </div>
    </div>
</header>