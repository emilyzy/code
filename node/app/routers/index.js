const express = require("express");
const path = require("path");
const router = express.Router();
const con=require("../sql.js");

router.get("/notices",(req,res)=>{
    con.query(`SELECT * FROM notice  ORDER BY sort LIMIT 0,3`, (err, data) => {
        if (!err) {
            res.send({
                data: data,
            })
        } else {
            throw err;
        }

    })
});


module.exports=router;