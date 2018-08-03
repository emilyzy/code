let News={
	template:"<div>news<h3>{{news.title}}</h3>{{news.content}}</div>",
	data:function(){
		return{
			news:{}
		}
	},
	mounted:function(){
		let url;
		if(this.$route.params.area==="guonei"){
			url="https://www.east-mock.com/mock/5b34884af818ba28881411fa/example_copy/news/guonei";
		}else{
			url="https://www.east-mock.com/mock/5b34884af818ba28881411fa/example_copy/news/guowai";
		}
		let xhr=new XMLHttpRequest();
		xhr.open("get",url);
		xhr.send();
		xhr.responseType="json";
		xhr.onload=function(){
			this.news=xhr.response.data;
		}.bind(this);
	},
	beforRouteUpdate:function(to,form,next){
		let url;
		if(to.path==="/news/guonei"){
			url="https://www.east-mock.com/mock/5b34884af818ba28881411fa/example_copy/news/guonei";
		}else{
			url="https://www.east-mock.com/mock/5b34884af818ba28881411fa/example_copy/news/guowai";
		}
		let xhr=new XMLHttpRequest();
		xhr.open("get",url);
		xhr.send();
		xhr.responseType="json";
		xhr.onload=function(){
			this.news=xhr.response.data;
			next();
		}.bind(this);
	}
};