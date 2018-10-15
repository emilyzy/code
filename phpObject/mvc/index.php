<?php
header("Content-Type:text/html;charset=utf-8");
//定义一些路径常量
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__ . DS);
//定义核心文件夹路径
define("LIBS_PATH", ROOT . "libs" . DS);
define("APP_PATH", ROOT . "app" . DS);
define("CONTROLLER_PATH", APP_PATH . "controller" . DS);
define("MODEL_PATH", APP_PATH . "model" . DS);
define("VIEW_PATH", APP_PATH . "view" . DS);
/*echo CONTROLLER_PATH;
echo "<br>";
echo LIBS_PATH;*/
define("WEB_PATH","//".$_SERVER["SERVER_NAME"].substr($_SERVER["SCRIPT_NAME"],0,strrpos($_SERVER["SCRIPT_NAME"],"/")+1));
define("CSS_PATH",WEB_PATH."static/css/");
define("JS_PATH",WEB_PATH."static/js/");
define("IMG_PATH",WEB_PATH."static/img/");
include LIBS_PATH . "router.class.php";
include LIBS_PATH . "db.class.php";
include LIBS_PATH . "Smarty.class.php";
$router = new router();