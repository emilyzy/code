<?php

/**
 * Created by PhpStorm.
 * User: emily
 * Date: 18-10-8
 * Time: 上午10:01
 */
class router
{
    public function __construct()
    {
        //c 当前要引入的控制器类是哪一个
        //a 调用的方法是哪一个
        $this->get();
    }
    function get(){
        $c=isset($_GET["c"])?$_GET["c"]:"index";
        $a=isset($_GET["a"])?$_GET["a"]:"init";
        $filename=CONTROLLER_PATH.$c."Controller.php";
        $modelname=MODEL_PATH.$c."Model.php";
        if(is_file($modelname)){
            include $modelname;
        }
        if(is_file($filename)){
            include $filename;
            if(class_exists($c)){
                $obj=new $c;
                if(method_exists($obj,$a)){
                    $obj->$a();
                }else{
                    echo "ERROR 方法不存在";
                }
            }else{
                echo "ERROR 类不存在";
            }
        }else{
            echo "ERROR 路径不存在";
        }

    }
}