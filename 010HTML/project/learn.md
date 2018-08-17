居中写法: left:clac(50% - npx);
鼠标箭头手型: cursor:pointer;
onmouseover有事件流效果;onmouseenter没有

user-select:none;   css里控制点击不选中效果
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;

vue通过数据进行样式控制;
先将状态和数据绑定,然后再添加点击事件;

mounted  生命周期函数

给tbody的tr设置不同的行:tbody>tr:nth-child(2n){background:red;}
鼠标滑过增加颜色        tbody>tr:horver{background:#aaa}