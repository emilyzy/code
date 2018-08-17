<template>
    <el-container class="container">
        <el-header class="header">平台后台管理系统</el-header>
        <el-container>
            <el-aside class="aside">
                <el-menu
                        :default-active="index"
                        class="el-menu-vertical-demo"
                        :router="true"
                >
                    <el-menu-item index="index" :route="{path:'/'}"><i class="el-icon-menu"></i><span>首页</span>
                    </el-menu-item>
                    <el-submenu index="1">
                        <template slot="title">
                            <i class="el-icon-star-on"></i>
                            <span>平台信息管理</span>
                        </template>
                        <el-menu-item index="workslist" :route="{path:'/workslist'}">作品管理</el-menu-item>
                        <el-menu-item index="articlelist" :route="{path:'/articlelist'}">文章管理</el-menu-item>
                        <el-menu-item index="videoslist" :route="{path:'/videoslist'}">视频管理</el-menu-item>
                        <el-menu-item index="recruitmentlist" :route="{path:'/recruitmentlist'}">招聘信息管理</el-menu-item>
                        <el-menu-item index="resumelist" :route="{path:'/resumelist'}">简历管理</el-menu-item>
                    </el-submenu>
                    <el-submenu index="2">
                        <template slot="title">
                            <i class="el-icon-star-on"></i>
                            <span>用户信息管理</span>
                        </template>
                        <el-menu-item index="userlist" :route="{path:'/userlist'}">个人信息管理</el-menu-item>
                        <el-menu-item index="companyReal" :route="{path:'/companyReal'}">企业资质认证</el-menu-item>
                    </el-submenu>
                    <el-submenu index="3">
                        <template slot="title">
                            <i class="el-icon-star-on"></i>
                            <span>面试管理</span>
                        </template>
                        <el-menu-item index="interviewlist" :route="{path:'/interviewlist'}">面试状态查看</el-menu-item>
                        <el-menu-item index="2-2">企业资质认证</el-menu-item>
                    </el-submenu>
                    <el-submenu index="4">
                        <template slot="title">
                            <i class="el-icon-star-on"></i>
                            <span>试题管理</span>
                        </template>
                        <el-menu-item index="2-1">个人信息管理</el-menu-item>
                        <el-menu-item index="2-2">企业资质认证</el-menu-item>
                    </el-submenu>
                </el-menu>
            </el-aside>
            <el-main>
                <slot></slot>
            </el-main>
        </el-container>
    </el-container>

</template>

<script>
    export default {
        name: "basicLayout",
        props: ["index"]
    }
</script>

<style scoped>
    .container {
        background:#F3F3F3;
        height: 100vh;
    }

    .header {
        height: 100px;
        background: #409EFF;
        line-height: 60px;
        font-size: 22px;
        font-weight: bold;
        text-align: center;
    }

    .aside {

        background: #fff;

    }
</style>