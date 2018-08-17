<template>
    <div>
        <el-row>
            <el-col :span="24"><div class="grid-content bg-purple-dark">1</div></el-col>
        </el-row>
        <el-row>
            <el-col :span="12"><div class="grid-content bg-purple">1</div></el-col>
            <el-col :span="12"><div class="grid-content bg-purple-light">2</div></el-col>
        </el-row>
    </div>
</template>


<script>
    export default {
        name: "Layout"
    }
</script>

<style scoped>
    .bg-purple-dark{
        background: #1f3a91;
    }
    .bg-purple{
        background: red;
    }
    .bg-purple-light{
        background: blue;
    }
</style>