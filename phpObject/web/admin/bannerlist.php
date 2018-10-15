<?php
include "../libs/db.php";
$sql="SELECT * FROM banner";
$r=$db->query($sql);
$data=$r->fetch_all(MYSQLI_ASSOC);//多行数据
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="../static/css/pintuer.css">
    <link rel="stylesheet" href="../static/css/admin.css">
    <script src="../static/js/jquery.js"></script>
    <script src="../static/js/pintuer.js"></script>
</head>
<body>
<form method="post" action="" id="listform">
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href="" style="float:right; display:none;">添加字段</a></div>

        <table class="table table-hover text-center">
            <tr>
                <th width="100" style="text-align:left; padding-left:20px;">ID</th>
                <th width="10%">排序</th>
                <th>图片</th>
                <th width="310">操作</th>
            </tr>
            <?php
            foreach ($data as $v):
            ?>
            <tr>
                <td><?php echo $v["id"]?></td>
                <td><?php echo $v["sort"]?></td>
                <td><img src="<?php echo $v["src"]?>" alt="" style="width: 50px;height: 50px;border-radius: 50%"></td>
                <td><div class="button-group"> <a class="button border-main" href="banneredit.php?id=<?php echo $v['id']?>"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="bannerdelete.php?id=<?php echo $v['id']?>" ><span class="icon-trash-o"></span> 删除</a> </div></td>
            </tr>
            <?php endforeach;?>
        </table>

    </div>
    <a class="button border-main icon-plus-square-o" href="banneradd.php"> 添加内容</a>
</form>
</body>
</html>