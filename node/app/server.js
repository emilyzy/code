const express = require("express");
const bodyParser=require("body-parser");
const app = express();
app.use(bodyParser.json());
app.use("/static", express.static("static"));

const adminRouter = require("./routers/admin");
app.use("/admin", adminRouter);

app.get("/", (req, res) => {
    res.redirect("/admin");
});
app.listen(8088, () => {
    console.log("ok");
});