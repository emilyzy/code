
<?php
include "../libs/db.php";
$sql="SELECT * FROM comments";
$r=$db->query($sql);
$data=$r->fetch_all(MYSQLI_ASSOC);
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
                <th width="10%">姓名</th>
                <th>文章id</th>
                <th>评论时间</th>
                <th>评论内容</th>
                <th width="310">操作</th>
            </tr>
            <?php foreach($data as $v):?>
                <tr>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $v['aid']?></td>
                    <td><?php echo $v['date']?></td>
                    <td><?php echo $v['content']?></td>
                    <td>
                        <div class="button-group"> <a class="button border-red del" href="commentdelete.php?id=<?php echo $v['id']?>"><span class="icon-trash-o"></span> 删除</a></div>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</form>
<script>
    $(".del").click(function(e){
        if(confirm("确定删除吗?")){

        }else{
           e.preventDefault();
        }
    })
</script>
</body>
</html>