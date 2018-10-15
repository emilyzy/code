<?PHP
include "../libs/db.php";
$sql="SELECT * FROM type ORDER BY sort";
$r=$db->query($sql);
$data=$r->fetch_all(MYSQLI_ASSOC);
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
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加文章</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="articleinsert.php">
            <div class="form-group">
                <div class="label">
                    <label>文章标题：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="title" data-validate="required:请输入标题" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>缩略图：</label>
                </div>
                <div class="field">
                    <input type="file" id="url" name="img" class="input tips" style="width:25%; float:left;"  value=""  data-toggle="hover" data-place="right" data-image="" />
                    <input type="button" class="button bg-blue margin-left" id="image" value="+ 浏览上传"  style="float:left;">
                    <div class="tipss">图片尺寸：500*500</div>
                    <input type="hidden" name="thumb" id="src" data-validate="required:请上传图片" >
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>发布日期：</label>
                </div>
                <div class="field">
                    <input type="date" class="input w50" value="" name="date" data-validate="required:请输入标题" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>分类：</label>
                </div>
                <div class="field">
                    <select name="tid" class="input w50">
                        <?PHP foreach ($data as $v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['typename']?></option>
                        <?php endforeach;?>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>文章内容：</label>
                </div>
                <textarea id="text" style="width:100%; height:200px;" name="content" hidden></textarea>
                <div class="field">
                    <!--富文本编辑-->
                    <div id="container"></div>
                    <div class="tips"></div>
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
<script src="../static/js/wangEditor.js"></script>
<script>
    $("#image").click(function(){
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
              success:function(r){
                 alert("上传成功");
                 $("#url").attr("data-image",r);
                 $("#src").val(r);
              }
          })
       }
    });
    var E = window.wangEditor;
    var editor = new E('#container');
    var $text = $('#text');
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $text.val(html)
    };
    editor.create();
    // 初始化 textarea 的值
    $text.val(editor.txt.html());
</script>
</body>
</html>