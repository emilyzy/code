<?php
//php官网搜image会有图像处理的函数
$image = imagecreatetruecolor(200, 64);//创建图像资源
//颜色填充
//1.创建一个颜色
//Math.random();
//mt_rand();
function getcolor($mode="l"){
    global $image;
    if($mode==="l"){
        return imagecolorallocate($image,mt_rand(120,255),mt_rand(120,255),mt_rand(120,255));
    }else{
        return imagecolorallocate($image,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
    }

}
//2.填充
imagefill($image,0,0,getcolor());
for($i=1;$i<100;$i++){
    imagesetpixel($image,mt_rand(0,200),mt_rand(0,50),getcolor("d"));
}
for($i=1;$i<20;$i++){
    imageline($image,mt_rand(0,200),mt_rand(0,50),mt_rand(0,200),mt_rand(0,64),getcolor("d"));
}
$str="sdhgrfvjnifghvesrujdvfnufdhdspijvnripgfhvjpisdjnfvhobdfiSDOURIVHRFSHIDVJIODHVUDFHXJSVUFUDBS23456789";
//strlen() 获取字符串函数
//substr() 获取某个位置固定长度的内容
$len=strlen($str);
session_start();
$word="";
for($i=0;$i<5;$i++){
    $character=substr($str,mt_rand(0,$len-1),1);
    $word.=$character;
    imagettftext($image,30,mt_rand(-30,30),$i*40+mt_rand(0,20),45,getcolor("d"),"./icon.ttf",$character);
}
$_SESSION["code"]=$word;
//生成一张图片
header("Content-type:image/png");
imagepng($image);

?>


















