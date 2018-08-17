<template>
    <basic-layout index="interviewlist">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
            <el-breadcrumb-item to="/interviewlist">面试列表</el-breadcrumb-item>
            <el-breadcrumb-item>面试详情</el-breadcrumb-item>
        </el-breadcrumb>
    <el-row>
        <el-col :span="12">
            <div>{{this.userMessage.realName}}</div>
        </el-col>
        <el-col :span="12">
            <div>{{this.companyMessage.name}}</div>
        </el-col>
    </el-row>
    </basic-layout>
</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "interviewshow",
        components:{
            "basic-layout":basicLayout
        },
        data(){
            return{
                userMessage:{},
                companyMessage:{}
            }
        },
        mounted() {
            let id=this.$route.params.id;
            this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getInterview?id="+id).then(res=>{
                let {cid}=res.body.data;
                let {uid}=res.body.data;
                this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getUser?uid="+uid).then(res=>{
                    this.userMessage=res.body.data;
                });
                this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getCompany?cid="+cid).then(res=>{
                    this.companyMessage=res.body.data;
                });
            })
        }
    }
</script>

<style scoped>

</style>