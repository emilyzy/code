<?php
/**
 * Created by PhpStorm.
 * User: emily
 * Date: 18-10-8
 * Time: 上午10:08
 */
/*echo "引入测试";*/

class index
{
    public function __construct()
    {
        $this->model = new indexModel();
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(VIEW_PATH);
        $this->smarty->setCompileDir(ROOT . "compile");
    }

    function init()
    {
        session_start();
        if (isset($_SESSION["login"])) {
            $this->smarty->display("index.html");
        } else {
            $this->smarty->assign("msg", "请先登录");
            $this->smarty->assign("href", "index.php?c=index&a=login");
            $this->smarty->display("tips.html");
        }
    }

    function login()
    {
        $this->smarty->display("login.html");
    }

    function sign()
    {
        $this->smarty->display("sign.html");
    }

    function checkname()
    {
        $name = $_GET["name"];
        $res = $this->model->checkname($name);
        echo $res;
    }

    function code()
    {
        $image = imagecreatetruecolor(200, 64);
        function getcolor($image,$mode = "l")
        {
            if ($mode === "l") {
                return imagecolorallocate($image, mt_rand(120, 255), mt_rand(120, 255), mt_rand(120, 255));
            } else {
                return imagecolorallocate($image, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
            }

        }

        imagefill($image, 0, 0, getcolor($image));
        for ($i = 1; $i < 100; $i++) {
            imagesetpixel($image, mt_rand(0, 200), mt_rand(0, 50), getcolor($image,"d"));
        }
        for ($i = 1; $i < 20; $i++) {
            imageline($image, mt_rand(0, 200), mt_rand(0, 50), mt_rand(0, 200), mt_rand(0, 64), getcolor($image,"d"));
        }
        $str = "sdhgrfvjnifghvesrujdvfnufdhdspijvnripgfhvjpisdjnfvhobdfiSDOURIVHRFSHIDVJIODHVUDFHXJSVUFUDBS23456789";
        $len = strlen($str);
        session_start();
        $word = "";
        for ($i = 0; $i < 5; $i++) {
            $character = substr($str, mt_rand(0, $len - 1), 1);
            $word .= $character;
            imagettftext($image, 30, mt_rand(-30, 30), $i * 40 + mt_rand(0, 20), 45, getcolor($image,"d"), "./icon.ttf", $character);
        }
        $_SESSION["code"] = $word;
        header("Content-type:image/png");
        imagepng($image);
    }
    function checksign(){
        session_start();
        $code=$_POST["code"];
        if(strtoupper($code)!==strtoupper($_SESSION["code"])){
            $this->smarty->assign("msg", "验证码错误");
            $this->smarty->assign("href", "index.php?c=index&a=sign");
            $this->smarty->display("tips.html");
            exit();
        }
        $name=$_POST["name"];
        $pass=$_POST["password"];
        $r=$this->model->insert($name,$pass);
        if($r==1){
            $this->smarty->assign("msg", "注册成功");
            $this->smarty->assign("href", "index.php?c=index&a=login");
            $this->smarty->display("tips.html");
        }else{
            $this->smarty->assign("msg", "注册失败");
            $this->smarty->assign("href", "index.php?c=index&a=sign");
            $this->smarty->display("tips.html");
        }
    }
    function checklogin(){
        session_start();
        $code=$_POST["code"];
        if(strtoupper($code)!==strtoupper($_SESSION["code"])){
            $this->smarty->assign("msg", "验证码错误");
            $this->smarty->assign("href", "index.php?c=index&a=login");
            $this->smarty->display("tips.html");
            exit();
        }
        $name=$_POST["name"];
        $pass=$_POST["password"];
        $r=$this->model->checklogin($name);
        if($r){
            if($r['password']===md5($pass)){
                $_SESSION["login"]=true;
                $this->smarty->assign("msg", "登陆成功");
                $this->smarty->assign("href", "index.php?c=index&a=init");
                $this->smarty->display("tips.html");
            }else{
                $this->smarty->assign("msg", "密码错误");
                $this->smarty->assign("href", "index.php?=index&a=login");
                $this->smarty->display("tips.html");
            }
        }else{
            $this->smarty->assign("msg", "用户名不存在");
            $this->smarty->assign("href", "index.php?c=index&a=login");
            $this->smarty->display("tips.html");
        }
    }
}