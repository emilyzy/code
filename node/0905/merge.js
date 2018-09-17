const fs=require("fs");
function mergeCss(path,target) {
    if(fs.existsSync(path)){
        if(fs.statSync(path).isDirectory()){
            let data=fs.readdirSync(path);
            let con="";
            data.forEach(name=>{
                if(fs.statSync(path+"/"+name).isFile()){
                    let text=fs.readFileSync(path+"/"+name,"utf-8");
                    con+=text+"\n";
                    fs.unlinkSync(path+"/"+name);
                }
            });
            fs.writeFileSync(target,con);
            console.log("合并完成");
        }else{
            console.log(path+"不是一个文件")
        }
    }else{
        console.log(path+"路径不存在")
    }
}
mergeCss("css","css/index.css");