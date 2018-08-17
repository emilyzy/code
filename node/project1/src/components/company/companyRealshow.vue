<template>
    <basic-layout index="companyReal">
        <div>{{obj.cid}}</div>
        <div>{{obj.name}}</div>
        <div>{{obj.logo}}</div>
        <div>{{obj.industry}}</div>
        <div>{{obj.typeOfEntenterprise}}</div>
        <div>{{obj.size}}</div>
        <div>{{obj.location}}</div>
        <div>{{obj.description}}</div>
        <div>{{obj.introduction}}</div>
        <div>{{obj.website}}</div>
        <div>{{obj.licence}}</div>
        <div>{{obj.state}}</div>
        <el-button type="primary" @click="$router.back()">返回</el-button>
    </basic-layout>
</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "companyRealshow",
        components:{
            "basic-layout":basicLayout
        },
        data(){
            return{
                obj:{}
            }
        },
        /*methods:{
            back(){
                this.$router.back
            }
        },*/
        mounted() {
            let id=this.$route.params.id;
            this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getCompany?cid="+id).then(res=>{
                if (res.status === 200) {
                    this.$message({
                        message: "获取成功",
                        type: "success"
                    });
                    this.obj=res.body.data;
                }
            })
        }
    }
</script>

<style scoped>

</style>