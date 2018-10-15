const express = require("express");
const path = require("path");
const router = express.Router();
const con=require("../sql.js");

router.get("/", (req, res) => {
    res.sendFile(path.resolve("./static/index.html"))
});

router.post("/checklogin",(req,res)=>{
    let {username,password}=req.body;
    con.query('SELECT * FROM admin WHERE username=?',username,(err,result)=>{
        if(!err){
            if (result.length>0){
                if(result[0].password===password){
                    res.send({
                        data:{
                            status:200,
                            msg:"ok"
                        }
                    })
                }else {
                    res.send({
                        data:{
                            status:10000,
                            msg:"wrong password"
                        }
                    })
                }
            }else{
                res.send({
                    data:{
                        status:10001,
                        msg:"wrong username"
                    }
                })
            }
        }else {
            throw err;
        }
    });
   /* console.log(req.body);*/

});

router.get("/getWorks",(req,res)=>{
    let p=req.query.p?req.query.p:1;
    let workName=req.query.workName;
    let type=req.query.type;
    if(workName&&type){
        con.query(`SELECT * FROM works WHERE workName LIKE "%${workName}%" AND type='${type}' LIMIT ${(p-1)*2},2;SELECT COUNT(*) AS total FROM works WHERE workName LIKE "%${workName}%" AND type='${type}'`,(err,data)=>{
            if(!err){
                res.send({
                    data:data[0],
                    total:data[1][0].total
                });
            }else{
                throw err;
            }
        });
    }else{
        con.query(`SELECT works.*,users.realName FROM works,users WHERE works.author=users.uid LIMIT ${(p-1)*2},2;SELECT COUNT(*) AS total FROM works`,(err,data)=>{
            if(!err){
                res.send({
                    data:data[0],
                    total:data[1][0].total
                });
            }else{
                throw err;
            }
        });
    }
});

router.get("/auditingwork",(req,res)=>{
    let {id,state}=req.query;
    con.query("UPDATE works SET state=? WHERE id="+id,state,(err,data)=>{
        if(!err){
            if(data.affectedRows==1){
                res.send({
                    data:{
                        message:"ok"
                    }
                })
            }
        }else{
            throw err;
        }
    })
});

router.get("/getArticles",(req,res)=>{
    let p=req.query.p-1;
    let {type,title}=req.query;
    if(title&&type){
        con.query(`SELECT * FROM articles WHERE title LIKE "%${title}%" AND type='${type}' LIMIT ${p*2},2;SELECT COUNT(*) AS total FROM articles WHERE title LIKE "%${title}%" AND type='${type}'`,(err,data)=>{
            if(!err){
                res.send({
                    data:data[0],
                    total:data[1][0].total
                });
            }else{
                throw err;
            }
        });
    }else{
        con.query(`SELECT * FROM articles LIMIT ${p*2},2;SELECT COUNT(*) AS total FROM articles`,(err,data)=>{
            if(!err){
                res.send({
                    data:data[0],
                    total:data[1][0].total
                });
            }else{
                throw err;
            }
        })
    }

});

router.get("/auditingArticle",(req,res)=>{
    let {aid,state}=req.query;
    con.query("UPDATE articles SET state=? WHERE aid="+aid,state,(err,data)=>{
        if(!err){
            if(data.affectedRows==1){
                res.send({
                    data:{
                        message:"ok"
                    }
                })
            }
        }else{
            throw err;
        }
    })
});

router.get("/getVideos",(req,res)=>{
    let p=req.query.p-1;
    let {type,title}=req.query;
    if(title&&type){
        con.query(`SELECT * FROM videos WHERE title LIKE "%${title}%" AND type='${type}' LIMIT ${p*2},2;SELECT COUNT(*) AS total FROM videos WHERE title LIKE "%${title}%" AND type='${type}'`,(err,data)=>{
            if(!err){
                res.send({
                    data:data[0],
                    total:data[1][0].total
                });
            }else{
                throw err;
            }
        });
    }else{
        con.query(`SELECT * FROM videos LIMIT ${p*2},2;SELECT COUNT(*) AS total FROM videos`,(err,data)=>{
            if(!err){

                res.send({
                    data:data[0],
                    total:data[1][0].total
                });
                console.log(data[1][0].total);
            }else{
                throw err;
            }
        })
    }
});

router.get("/auditvideo",(req,res)=>{
    let {vid,state}=req.query;
    con.query("UPDATE videos SET state=? WHERE vid="+vid,state,(err,data)=>{
        if(!err){
            if(data.affectedRows==1){
                res.send({
                    data:{
                        message:"ok"
                    }
                })
            }
        }else{
            throw err;
        }
    })
});

router.get("/getRecruitment",(req,res)=>{
    let p=req.query.p?(req.query.p-1):0;
        con.query(`SELECT * FROM recruitments LIMIT ${p*2},2;SELECT COUNT(*) AS total FROM recruitments`,(err,data)=>{
            /*console.log(data);*/
            if(!err){
                res.send({
                    data:data[0],
                    total:data[1][0].total
                });
            }else{
                throw err;
            }
            /*console.log(data);*/
        });
});

router.get("/auditingRecruitment",(req,res)=>{
    let {rid,state}=req.query;
    con.query("UPDATE recruitments SET state=? WHERE rid="+rid,state,(err,data)=>{
        if(!err){
            if(data.affectedRows==1){
                res.send({
                    data:{
                        message:"ok"
                    }
                })
            }
        }else{
            throw err;
        }
    })
});

router.get("/getResume",(req,res)=>{
    let p=req.query.p?(req.query.p-1):0;
    con.query(`SELECT * FROM resumes LIMIT ${p*2},2;SELECT COUNT(*) AS total FROM resumes`,(err,data)=>{
        /*console.log(data);*/
        if(!err){
            res.send({
                data:data[0],
                total:data[1][0].total
            });
        }else{
            throw err;
        }
        /*console.log(data);*/
    });
});

router.get("/auditingResume",(req,res)=>{
    let {rid,state}=req.query;
    con.query("UPDATE resumes SET state=? WHERE rid="+rid,state,(err,data)=>{
        if(!err){
            if(data.affectedRows==1){
                res.send({
                    data:{
                        message:"ok"
                    }
                })
            }
        }else{
            throw err;
        }
    })
});

//用户信息获取
router.get("/getUsers",(req,res)=>{
    let p=req.query.p-1;
    con.query(`SELECT * FROM users LIMIT ${p*2},2;SELECT COUNT(*) AS total FROM users`,(err,data)=>{
        if(!err){
            res.send({
                data:data[0],
                total:data[1][0].total
            });
        }else{
            throw err;
        }
    })
});

router.get("/getUser",(req,res)=>{
   let uid=req.query.uid;
   con.query("SELECT * FROM users WHERE uid="+uid,(err,data)=>{
       if(!err){
           res.send({
               data:data[0]
           });
       }else{
           throw err;
       }
   })
});

router.get("/delUser",(req,res)=>{
    let uid=req.query.uid;
    con.query("DELETE FROM users WHERE uid="+uid,(err,data)=>{
        if(!err){
            res.send({
                data:data[0]
            });
        }else{
            throw err;
        }
    })
});

router.get("/notices",(req,res)=>{
    let p=req.query.p-1;
    con.query(`SELECT * FROM notice ORDER BY sort LIMIT ${p * 2},2;SELECT COUNT(*) AS total FROM notice`,(err,data)=>{
        if(!err){
            res.send({
                data:data[0],
                total:data[1][0].total
            })
        }else{
            throw err;
        }
    })
});
router.delete("/notices/:id",(req,res)=>{
    let id=req.params.id;
    con.query("DELETE FROM notice WHERE id="+id,(err,data)=>{
        if(!err){
            if(data.affectedRows===1){
                res.send("ok");
            }else{
                res.send("err")
            }
        }else{
            throw err;
        }
    })
});
router.post("/notices",(req,res)=>{
    let {content,date,sort}=req.body;
    con.query("INSERT INTO notice(content,date,sort)VALUES(?,?,?)",[content,date,sort],(err,data)=>{
        if(!err){
            if(data.affectedRows===1){
                res.send("ok");
            }else{
                res.send("err")
            }
        }else{
            throw err;
        }
    })
});
router.get("/notices/:id",(req,res)=>{
    let id=req.params.id;
    con.query("SELECT * FROM notice WHERE id="+id,(err,data)=>{
        if(!err){
            res.send(data[0])
        }else{
            throw err;
        }
    })
});
router.put("/notices",(req,res)=>{
    let {id,content,sort,date}=req.body;
    con.query("UPDATE notice SET content=?,sort=?,date=? WHERE id=?",[content,sort,date,id],(err,data)=>{
        if(!err){
            if(data.affectedRows===1){
                res.send("ok");
            }else{
                res.send("error")
            }
        }else{
            throw err;
        }
    })
});
module.exports = router;