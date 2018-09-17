<template>
    <basic-layout index="userlist">

        <div>{{obj.uid}}</div>
        <div>{{obj.nickName}}</div>
        <div>{{obj.sex}}</div>
        <div>{{obj.age}}</div>
        <div><img :src="obj.avatar" alt="" style="height: 50px; width: 50px; border-radius: 50%; background:no-repeat center/100% auto"></div>
        <div>{{obj.workState}}</div>
        <div>{{obj.realmame}}</div>
        <div>{{obj.targetPosition}}</div>
        <div>{{obj.targetSalary}}</div>
        <div>{{obj.phone}}</div>
        <div>{{obj.email}}</div>
        <div>{{obj.password}}</div>
        <div>{{obj.school}}</div>
        <div>{{obj.professional}}</div>
        <div>{{obj.graduationDate}}</div>
        <div>{{obj.record}}</div>
        <div>{{obj.experience}}</div>
        <el-button type="primary" @click="$router.back()">返回</el-button>
    </basic-layout>
</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "usershow",
        components:{
            "basic-layout":basicLayout
        },
        data(){
            return{
                obj:{},
            }
        },
        /*methods:{
            back(){
                this.$router.back
            }
        },*/
        mounted() {
            let id=this.$route.params.id;
            this.$http.get("admin/getUser?uid="+id).then(res=>{
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