let count;
let choose=$(".modeChoose");
$("#start").click(function () {
    $(this).hide();
    $("#mode").slideDown(300);
});
$("#mode>div").click(function () {
    if($(this).hasClass("easy")){
        count=10;
        choose.html("Easy");
    }
    if($(this).hasClass("mid")){
        count=15;
        choose.html("Middle");
    }
    if($(this).hasClass("dif")){
        count=20;
        choose.html("Difficult");
    }
    creatBox();
    $(".flagtag").html(count);
    $("#mask").hide(500);
});

function creatBox() {
    do {
        $("#box").empty();
        for (let i = 0; i < 10; i++) {
            for (let j = 0; j < 10; j++) {
                let isLandmine;
                if(count==10){
                    isLandmine = Math.random() > 0.9;
                }
                if(count==15){
                    isLandmine = Math.random() > 0.85;
                }
                if(count==20){
                    isLandmine = Math.random() > 0.80;
                }
                $("<div>")
                    .addClass(function () {
                        return "landmine " + (isLandmine ? "landmine1" : "");
                    })
                    .appendTo($("#box"))
                    .attr("id",i+"-"+j);
            }
        }
    }while ($(".landmine1").length!==count);
}
$("#box").on("click",".landmine",clickHandler);
$("#box").one("click",setTime);
function clickHandler() {
    if($(this).hasClass("landmine1")){
        $(".landmine1").addClass("show");
        alert("游戏结束");
        gameOver(false);
        return;
    }
    if($(this).hasClass("number")){
        return;
    }
    if ($(this).hasClass("flag")){
        return;
    }
    $(this).addClass("number");
    let n=0;
    let id=$(this).attr("id");
    let x=parseInt(id.charAt(0));
    let y=parseInt(id.charAt(2));
    /*console.log(x,y)
     return;*/
    /* if($("#"+"i"+"-"+"j")){}*/
    for(let i=x-1;i<=x+1;i++){
        for(let j=y-1;j<=y+1;j++){
            if ($("#"+i+"-"+j).hasClass("landmine1")){
                n++;
            }
        }
    }
    $(this).html(n);
    /*console.log(n)
     return;*/
    if(n===0){
        for(let i=x-1;i<=x+1;i++){
            for(let j=y-1;j<=y+1;j++){
                let obj=$("#"+i+"-"+j);
                if(!obj.hasClass("number")&&obj.length===1){
                    clickHandler.call(obj[0]);
                }
            }
        }
    }
}
//right click
$("#box").on("contextmenu",".landmine:not(.number)",function (e) {
    e.preventDefault();
    $(this).toggleClass("flag");
    let flagtag=$(this).hasClass("flag");
    $(".flagtag").html(function (index,oldVal) {
        return flagtag?oldVal-1:parseInt(oldVal)+1;
    });
    if($(".landmine1").filter(".flag").length==count&&$(".flag").html()==0){
        alert("恭喜你,成功啦!");
        gameOver(true);
    }
});
//set time
let t;
function setTime() {
    let time=0;
    //clearInterval(t);
    t=setInterval(function () {
        time++;
        $(".time").html(time);
    },1000);
}
//game over
function gameOver(result) {
    let time=$(".time").html();
    $("#mask").show();
    $("#mode").hide();
    $("#end").slideDown(300);
    $(".message").html(function () {
        return (result?"<span class='sucess'>Success</span>&nbsp&nbsp":"<span class='fail'>Fail</span>&nbsp&nbsp")+"Use"+time+"s";
    })
}
$(".restart").click(function () {
    creatBox();
    //$(".flagtag").html(count);
    $("#mask").hide(500);
    clearInterval(t);
    $("#box").one("click",setTime);
    $(".time").html(0);
});
$(".rechoose").click(function () {
    $("#end").hide(500);
    $("#mask").show();
    $("#mode").slideDown(300);
    clearInterval(t);
    $("#box").one("click",setTime);
    $(".time").html(0);
    /*creatBox();
     $(".flagtag").html(count);
     $("#mask").hide(500);
     */
})