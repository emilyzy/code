const mysql=require("mysql");
const con=mysql.createConnection({
    host:"localhost",
    user:"root",
    password:"123",
    database:"app",
    multipleStatements:true
});
con.connect();
module.exports=con;
