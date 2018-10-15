<?php
include_once "../libs/db.php";
$sql = "SELECT * FROM banner ORDER BY sort";
$r = $db->query($sql);
$banner = $r->fetch_all(MYSQLI_ASSOC);
?>
<!--banner-->

<ol class="carousel-indicators">
    <?php
    $t = 0;
    foreach ($banner as $v):
        ?>
        <li data-target="#carousel-example-generic"
            data-slide-to="<?php echo $t; ?>" <?php if ($t == 0) {
            echo "class='active'";
        } ?>></li>
        <?php
        $t++;
    endforeach; ?>
</ol>

<div class="carousel-inner" role="listbox">
    <?php
    $t = 0;
    foreach ($banner as $v): ?>
        <div class="item <?php if ($t == 0): ?>active<?php endif; ?>"><a href="" target="_blank"><img
                    src="<?php echo $v['src'] ?>" alt=""
                    style="width:100%;height:250px;"/></a>
            <span class="carousel-bg"></span></div>
        <?php
        $t++;
    endforeach; ?>
</div>

<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span
        class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span>
</a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span>
</a></div>
<!--/banner-->
