<template>
    <el-container>
        <el-header class="header">Header</el-header>
        <el-container>
            <el-aside width="200px" class="aside">Aside</el-aside>
            <el-main class="main">Main</el-main>
        </el-container>
    </el-container>

</template>

<script>
    export default {
        name: "Container"
    }
</script>

<style scoped>
.header{
    background: aqua;
}
    .aside{
        background: aquamarine;
    }
    .main{
        background: blueviolet;
    }
</style>