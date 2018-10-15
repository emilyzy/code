<?php
$id=$_GET["id"];
include "../libs/db.php";
$sql="SELECT * FROM banner WHERE id=$id";
$r=$db->query($sql);
$data=$r->fetch_assoc();
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
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>编辑内容</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="bannerupdate.php">
            <input type="hidden" name="id" value="<?php echo $data['id']?>">
            <div class="form-group">
                <div class="label">
                    <label>排序：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo $data['sort']?>" name="sort" data-validate="required:请输入排序"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>图片：</label>
                </div>
                <div class="field">
                    <input type="file" id="url" name="img" class="input tips" style="width:25%; float:left;" value=""
                           data-toggle="hover" data-place="right" data-image="<?php echo $data['src']?>"/>
                    <input type="button" class="button bg-blue margin-left" id="image" value="+ 浏览上传"
                           style="float:left;">
                    <div class="tipss">图片尺寸：500*500</div>
                    <input type="hidden" name="src" id="src" data-validate="required:请上传图片" value="<?php echo $data['src']?>">
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $("#image").click(function () {
        var file=$("#url").get(0).files[0];
        if(file){
            var fd=new FormData();
            fd.append("img",file);
            $.ajax({
                url:"../libs/upload.php",
                data:fd,
                type:"post",
                processData:false,
                contentType:false,
                success:function (r) {
                    alert("上传成功");
                    $("#url").attr("data-image",r);
                    $("#src").val(r);
                }
            })
        }
    })
</script>
</body>
</html>