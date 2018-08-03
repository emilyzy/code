const container=document.querySelector(".words2-bottom-news-container");
let r=0;
let t1=setInterval(a,5000);
function a() {
    if (r===0){
        container.style.transition="";
    }
    r++;
    console.log(r)
    container.style.top=-r*40+"px";
}
container.addEventListener("transitionend",function () {
   if (r===5){
       container.style.transition="none";
       container.style.transition="0";
       r=0;
   }
});
container.onmouseenter=function () {
    clearInterval(t1);
};
container.onmouseleave=function () {
    t1=setInterval(a,5000);
};
//窗口获得焦点
window.onfocus=function () {
    t1=setInterval(a,2000);
};
window.onblur=function () {
    clearInterval(t1);
};