<template>
    <basic-layout index="userlist">
        <el-row class="message-container" :span="16" v-loading="loading">
            <ul>
                <li>姓名：<span>{{obj.realmame}}</span></li>
                <li>昵称：<span>{{obj.nickName}}</span></li>
                <li>性别：<span>{{obj.sex}}</span></li>
                <li>年龄：<span>{{obj.age}}</span></li>
                <li><img :src="obj.avatar" alt="" style="with:50px;height:50px;border-radius:50%;"></li>
                <li>个性签名：<span>{{obj.autograph}}</span></li>
                <li>工作状态：<span>{{obj.workState}}</span></li>
                <li>目标职位：<span>{{obj.targetPosition}}</span></li>
                <li>目标薪资：<span>{{obj.targetSalary}}</span></li>
                <li>联系电话：<span>{{obj.phone}}</span></li>
                <li>电子邮箱：<span>{{obj.email}}</span></li>
                <li>学校：<span>{{obj.school}}</span></li>
                <li>专业：<span>{{obj.professional}}</span></li>
                <li>毕业日期：<span>{{obj.graduationDate}}</span></li>
                <li>学历：<span>{{obj.record}}</span></li>
                <li>工作经验：<span>{{obj.experience}}</span></li>
            </ul>
        </el-row>
        <el-button type="primary" @click="$router.back()">返回</el-button>
    </basic-layout>
</template>

<script>
    import Layout from '../basicLayout'

    export default {
        name: "usershow",
        components: {
            "basic-layout": Layout
        },
        data() {
            return {
                obj: {},
                loading: true,
            }
        },
        // methods:{
        //     back(){
        //         this.$router.back()
        //     }
        // },
        mounted() {
            let id = this.$route.params.id;
            this.$http.get("admin/getUser?uid=" + id).then(res => {
                if (res.status === 200) {
                    this.$message({
                        type: "success",
                        message: "获取成功"
                    });
                    this.obj = res.body.data;
                    this.loading = false;
                }
            })
        }
    }
</script>

<style scoped>
    .message-container{
        border:1px solid #ccc;
        min-height:500px;
        margin:30px 0;
        background: #1fb4f5;
    }
</style>