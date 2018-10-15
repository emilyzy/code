<?php
include "../libs/db.php";
$sql = "SELECT article.*,type.typename FROM article,type WHERE article.tid=type.id";
$r = $db->query($sql);
$data = $r->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
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
        <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong> <a href=""
                                                                               style="float:right; display:none;">添加字段</a>
        </div>
        <div class="padding border-bottom">
            <ul class="search" style="padding-left:10px;">
                <li><a class="button border-main icon-plus-square-o" href="articleadd.php"> 添加内容</a></li>
            </ul>
        </div>
        <table class="table table-hover text-center">
            <tr>
                <th width="100" style="text-align:left; padding-left:20px;">ID</th>
                <th>标题</th>
                <th>发布日期</th>
                <th>所属分类</th>
                <!--<th width="310">操作</th>-->
            </tr>
            <?php foreach ($data as $v): ?>
                <tr>
                    <td><?php echo $v['id'] ?></td>
                    <td><?php echo $v['title'] ?></td>
                    <td><?php echo $v['date'] ?></td>
                    <td><?php echo $v['typename'] ?></td>
                    <!--<td>
                        <div class="button-group"><a class="button border-main"
                                                     href="typeedit.php?id=<?php /*echo $v['id'] */?>"><span
                                        class="icon-edit"></span> 修改</a> <a class="button border-red"
                                                                            href="typedelete.php?id=<?php /*echo $v['id'] */?>"><span
                                        class="icon-trash-o"></span> 删除</a></div>
                    </td>-->
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</form>
</body>
</html>