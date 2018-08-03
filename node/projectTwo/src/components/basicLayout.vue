<template>
    <el-container class="container">
        <el-header class="header">大学生就业服务平台后台管理系统</el-header>
        <el-container>
            <el-aside width="240px" class="aside">
                <el-menu
                        :default-active="index"
                        class="el-menu-vertical-demo"
                        :unique-opened="false"
                        :router="true"
                        background-color="#545c64"
                        text-color="#fff"
                        active-text-color="#ffd04b"
                >
                    <el-menu-item index="index" :route="{path:'/'}"><i class="el-icon-menu"></i><span>首页</span></el-menu-item>
                    <el-submenu index="1">
                        <template slot="title">
                            <i class="el-icon-star-on"></i>
                            <span>平台信息管理</span>
                        </template>
                        <el-menu-item index="1-1" :route="{path:'/workslist'}">作品管理</el-menu-item>
                        <el-menu-item index="1-2" :route="{path:'/layout'}">文章管理</el-menu-item>
                        <el-menu-item index="1-3" :route="{path:'/layout'}">视频管理</el-menu-item>
                        <el-menu-item index="1-4" :route="{path:'/layout'}">招聘信息管理</el-menu-item>
                        <el-menu-item index="1-5" :route="{path:'/layout'}">聊天记录管理</el-menu-item>
                    </el-submenu>
                    <el-submenu index="2">
                        <template slot="title">
                            <i class="el-icon-star-on"></i>
                            <span>用户信息管理</span>
                        </template>
                        <el-menu-item index="2-1" :route="{path:'/layout'}">个人信息</el-menu-item>
                        <el-menu-item index="2-2" :route="{path:'/layout'}">企业资质认证</el-menu-item>
                    </el-submenu>
                </el-menu>
            </el-aside>
            <el-container>
                <el-main>
                    <slot></slot>
                </el-main>
            </el-container>
        </el-container>
    </el-container>
</template>

<script>
    export default {
        name: "basicLayout",
        props:["index"]
    }
</script>

<style scoped>
    .container {
        height: 800px;
        background: #cfcfcf;
    }

    .header {
        /*height: 100px;*/
        background: #666;
        line-height: 60px;
        font-size: 20px;
        font-weight: bold;
        color: #fff;
    }

    .aside {
        background: #817f85;
    }
</style>
