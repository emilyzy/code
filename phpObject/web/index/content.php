<?php
$id = $_GET["aid"];
include_once "../libs/db.php";
$sql = "SELECT article.*,type.typename FROM article,type WHERE article.tid=type.id AND article.id=$id";
$r = $db->query($sql);
$data = $r->fetch_assoc();
//获取当前文章评论信息
$sql = "SELECT * FROM comments WHERE aid=$id";
$r = $db->query($sql);
$comments = $r->fetch_all(MYSQLI_ASSOC);
$sql = "SELECT * FROM article WHERE id>$id LIMIT 1";
$r = $db->query($sql);
$next = $r->fetch_assoc();
$sql = "SELECT * FROM article WHERE id<$id ORDER BY id DESC LIMIT 1";
$r = $db->query($sql);
$prev = $r->fetch_assoc();
?>

<!doctype html>
<html>

<?php include_once "header.php" ?>

<body>
<section class="container user-select">
    <?php include_once "nav.php" ?>
    <!--/超小屏幕可见-->
    <div class="content-wrap" style="height: auto"><!--内容-->
        <div class="content">
            <header class="news_header">
                <h2><?php echo $data["title"] ?></h2>
                <ul>
                    <li>发布于 <?php echo $data["date"] ?></li>
                    <li>栏目：<a href="list.php?tid=<?php echo $data['tid'] ?>&typename=<?php echo $data["typename"] ?>"
                              title="" target="_blank"><?php echo $data["typename"] ?></a></li>
                </ul>
            </header>
            <article class="news_content">
                <?php echo $data['content'] ?>
            </article>
            <nav class="page-nav"> <span class="page-nav-prev">上一篇<br/>
                    <?php if ($prev): ?>
                        <a href="content.php?aid=<?php echo $prev['id'] ?>"
                           rel="prev"><?php echo $prev['title'] ?></a>
                    <?php else: ?>
                        <a href="">上一篇没有了</a>
                    <?php endif; ?>
                </span> <span class="page-nav-next">下一篇<br/>
                    <?php if ($next): ?>
                        <a href="content.php?aid=<?php echo $next['id'] ?>"
                           rel="next"><?php echo $next['title'] ?></a>
                    <?php else: ?>
                        <a href="">下一篇没有了</a>
                    <?php endif; ?>
                </span></nav>

            <div class="content-block comment">
                <h2 class="title"><strong>评论</strong></h2>
                <form action="comment.php" method="post" class="form-inline" id="comment-form">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <div class="comment-title">
                        <div class="form-group">
                            <label for="commentName">昵称：</label>
                            <input type="text" name="name" class="form-control" id="commentName"
                                   placeholder="技术博客">
                        </div>

                    </div>
                    <div class="comment-form">
                        <textarea placeholder="你的评论可以一针见血" name="content" required></textarea>
                        <div class="comment-form-footer">
                            <div class="comment-form-text">欢迎评论</div>
                            <div class="comment-form-btn">
                                <button type="submit" class="btn btn-default btn-comment">提交评论</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="comment-content">
                    <ul>
                        <?php foreach ($comments as $v): ?>
                            <li> <span
                                        class="text"><strong><?php echo $v['name'] ?></strong> 在 <?php echo $v['date'] ?>
                                    说：<br/><?php echo $v['content'] ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/内容-->
    <?php include "search.php"?>
    <!--/右侧>992px显示-->
    <footer class="footer">POWERED BY &copy;<a href="#">技术博客 EMILY.COM</a>
        &nbsp;&nbsp;&nbsp</footer>
</section>
<div><a href="javascript:;" class="gotop" style="display:none;"></a></div>
<!--/返回顶部-->
<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="js/nprogress.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
    //页面加载
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function () {
        NProgress.done();
        $('.fade').removeClass('out');
    }, 1000);
    //返回顶部按钮
    $(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 100) {
                $(".gotop").fadeIn();
            }
            else {
                $(".gotop").hide();
            }
        });
        $(".gotop").click(function () {
            $('html,body').animate({'scrollTop': 0}, 500);
        });
    });
    //提示插件启用
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    //鼠标滑过显示 滑离隐藏
    //banner
    $(function () {
        $(".carousel").hover(function () {
            $(this).find(".carousel-control").show();
        }, function () {
            $(this).find(".carousel-control").hide();
        });
    });
    //本周热门
    $(function () {
        $(".hot-content ul li").hover(function () {
            $(this).find("h3").show();
        }, function () {
            $(this).find("h3").hide();
        });
    });
    //相关推荐
    $(function () {
        $(".related-content ul li").hover(function () {
            $(this).find("h3").show();
        }, function () {
            $(this).find("h3").hide();
        });
    });
    //页面元素智能定位
    $.fn.smartFloat = function () {
        var position = function (element) {
            var top = element.position().top; //当前元素对象element距离浏览器上边缘的距离
            var pos = element.css("position"); //当前元素距离页面document顶部的距离
            $(window).scroll(function () { //侦听滚动时
                var scrolls = $(this).scrollTop();
                if (scrolls > top) { //如果滚动到页面超出了当前元素element的相对页面顶部的高度
                    if (window.XMLHttpRequest) { //如果不是ie6
                        element.css({ //设置css
                            position: "fixed", //固定定位,即不再跟随滚动
                            top: 0 //距离页面顶部为0
                        }).addClass("shadow"); //加上阴影样式.shadow
                    } else { //如果是ie6
                        element.css({
                            top: scrolls  //与页面顶部距离
                        });
                    }
                } else {
                    element.css({ //如果当前元素element未滚动到浏览器上边缘，则使用默认样式
                        position: pos,
                        top: top
                    }).removeClass("shadow");//移除阴影样式.shadow
                }
            });
        };
        return $(this).each(function () {
            position($(this));
        });
    };
    //启用页面元素智能定位
    $(function () {
        $("#search").smartFloat();
    });


    //ajax更新点赞值
    $(function () {
        $(".content .zambia a").click(function () {
            var zambia = $(this);
            var id = zambia.attr("rel"); //对应id
            zambia.fadeOut(1000); //渐隐效果
            $.ajax({
                type: "POST",
                url: "zambia.php",
                data: "id=" + id,
                cache: false, //不缓存此页面
                success: function (data) {
                    zambia.html(data);
                    zambia.fadeIn(1000); //渐显效果
                }
            });
            return false;
        });
    })
</script>
</body>
</html>
