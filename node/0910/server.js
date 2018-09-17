const express=require("express");
const path=require("path");
const multer=require("multer");
const mime=require("mime");
const app=express();
const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './upload')
    },
    filename: function (req, file, cb) {
        let ext=mime.getExtension(file.mimetype);
        cb(null,Date.now()+"."+ext);
    }
});
const upload = multer({ storage: storage });

app.use("/static",express.static("static"));
app.use("/upload",express.static("upload"));
app.get("/",(req,res)=>{
    res.sendFile(path.resolve("views/index.html"));

});
app.post("/upload",upload.array("f"),(req,res)=>{
    let url="";
    for(let i=0;i<req.files.length;i++){
        url+="/upload/"+req.files[i].filename+";"
    }
    res.send(url);
});
app.listen(8080,function(){
    console.log("服务器开启成功");
});