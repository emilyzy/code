const fs=require("fs");
function deletedir(path) {
    let files=fs.readdirSync(path);
    if(files.lenght>0){
        files.forEach(val=>{
            let newpath=path+"\/"+val;
            let statObj=fs.statSync(newpath);
            if(statObj.ifFile()){
                fs.unlinkSync(newpath);
            }else{
                deletedir(newpath);
            }
        })
    }
    fs.rmdirSync(path);
}

deletedir("test");
