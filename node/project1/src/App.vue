<template>
    <div id="app">
        <div v-if="isLogin">
            <router-view/>
        </div>
        <div v-else id="login">
            <el-row type="flex" justify="center" align="middle" class="my-row">
                <el-col :span="8" class="wrapper">
                    <el-form ref="form" :model="form" label-width="80px" :rules="rules">
                        <el-form-item label="用户名" prop="username">
                            <el-input v-model="form.username"></el-input>
                        </el-form-item>
                        <el-form-item label="密码" prop="password">
                            <el-input v-model="form.password" type="password"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="success" @click="submit">登录</el-button>
                        </el-form-item>
                    </el-form>
                </el-col>
            </el-row>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data(){
            return{
                isLogin:false,
                form:{
                    username:"",
                    password:""
                },
                rules:{
                    username:[
                        {
                            required:true,
                            message:"请填写用户名",
                            trigger:"blur"
                        }
                    ],
                    password:[
                        {
                            required:true,
                            message:"请填写密码",
                            trigger:"blur"
                        }
                    ]
                }
            }
        },methods:{
            submit(){
                //在一个服务器当中 跨域 一个服务器不能去直接请求另一台服务器数据
                //跨域  协议 域名 端口号 一致才算做同域
                //跨域问题只有在浏览器中请求的时候才有,服务器发起没有
                //解决跨域问题
                //1.在被请求的服务器中设置允许跨域
                //2.设置代理 请求还是直接找当前的服务器
                this.$refs.form.validate((valid)=>{
                    if(valid){
                        this.$http.post("/admin/checklogin",this.form).then(res=>{
                            /*console.log(res);*/

                            if(res.body.data.status===10000){
                                this.$message({
                                    message:"密码错误",
                                    type:"error"
                                })
                            }else if(res.body.data.status===10001){
                                this.$message({
                                    message:"账号不存在",
                                    type:"error"
                                })
                            }else if(res.body.data.status===200){
                                this.$message({
                                    message:"登录成功",
                                    type:"success"
                                });
                                sessionStorage.login="true";
                                this.isLogin=true;
                            }
                        })
                    }else{
                        console.log('登录失败');
                        return false;
                    }
                })
            }
        },
        beforeMount(){
            if(sessionStorage.login){
                this.isLogin=true;
            }

        }
    }
</script>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    a {
        text-decoration: none;
        color: #4caa3a;
    }
    html,body,#app{
        width: 100%;
        height: 100%;
    }
    #login{
        width: 100%;
        height: 100%;
    }
    .wrapper{
        padding: 40px 40px 0 0;
        border: 1px solid rgba(194, 192, 192, 0.85);
        box-shadow: 3px 2px rgba(97, 95, 95, 0.78);
        border-radius: 5px;
    }
    .my-row{
        width: 100%;
        height: 100%;
    }
</style>
