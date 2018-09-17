const express=require("express");

const app=express();
const session=require("express-session");
const path=require("path");
const mysql=require("mysql");
const con=mysql.createConnection({
    host:"localhost",
    user:"root",
    password:"123",
    database:"test"
});
con.connect();
con.query("SELECT * FROM student",(error,data)=>{
    console.log(data);
});
app.use(session({
    secret:"keyboard cat",
    name:"sid",
    cookie:{maxAge:60000},
    resave:true,
    saveUninitialized:true
}));
app.get("/",(req,res)=>{
    if(req.session.views){
        req.session.views++;
    }else{
        req.session.views=1;
    }
    res.send("123");
});
app.listen(8080,()=>{
    console.log("服务器开启成功");
});
//express-session
//第一次,服务器会向浏览器设置一个cookie  sessionid 代号 服务器通过这个代号保存一些信息
//第二次,浏览器将cookie发送到服务器 接收到这个sessionid就可以根据这个id来获取相应的信息

//express.static()
//body-parser
//multer
//cookie-parser
//express-session