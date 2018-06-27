let btns=document.querySelectorAll(".btn");
let boxs=document.querySelectorAll(".box");
for (let i=0;i<btns.length;i++){
    btns[i].onclick=function () {
        for (let j=0;j<btns.length;j++){
            btns[j].classList.remove("active");
            boxs[j].classList.remove("active2");
        }
        this.classList.add("active");
        boxs[i].classList.add("active2");
    }
}