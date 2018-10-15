<template>
    <basic-layout index="userlist">
        <el-table
                :data="data"
                style="width:100%"
        >
            <el-table-column
                    prop="realName"
                    label="真实姓名"
                    align="center">
            </el-table-column>
            <el-table-column
                    prop="sex"
                    align="center"
                    label="性别">
            </el-table-column>
            <el-table-column
                    sortable
                    prop="age"
                    align="center"
                    label="年龄">
            </el-table-column>
            <el-table-column
                    prop="avatar"
                    label="头像"
                    align="center"
                    width="180">
                <template slot-scope="scope">
                    <img :src="scope.row.avatar" alt="" style="with:50px;height:50px;border-radius:50%;">
                </template>
            </el-table-column>
            <el-table-column
                    sortable
                    prop="targetSalary"
                    label="目标薪资">
            </el-table-column>
            <el-table-column
                    sortable
                    align="center"
                    prop="experience"
                    label="工作经验">
            </el-table-column>

            <el-table-column
                    label="操作"
                    width="200">
                <template slot-scope="scope">
                    <el-button type="success" :plain="true"><router-link :to="{path:'/usershow/'+scope.row.uid}">查看</router-link></el-button>
                    <el-button type="warning" :plain="true" @click="del(scope.row.uid)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-row type="flex" justify="center" style="margin-top: 30px">
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :page-size="2"
                    :total="total"
                    @current-change="change"
            >
            </el-pagination>
        </el-row>
    </basic-layout>
</template>

<script>
    import Layout from '../basicLayout'
    export default {
        name: "userlist",
        components: {
            "basic-layout": Layout
        },
        data(){
            return{
                data:[],
                loading:true,
                total:0
            }
        },
        methods:{
            del(id){
                this.$confirm('确定删除当前用户吗?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.get("admin/delUser?uid="+id).then(res=>{
                        if(res.body.data.state==="success"){
                            this.$message({
                                type: 'success',
                                message: '删除成功！'
                            });
                            this.data=this.data.filter(ele=>ele.uid!==id);
                        }else{
                            this.$message({
                                type: 'error',
                                message: '删除失败'
                            });
                        }
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            getData:function (page=1) {
                this.$http.get("admin/getUsers?p="+page).then(res=>{
                    if(res.status===200){
                        this.total=res.body.total;
                        this.data=res.body.data;
                        this.$message({
                            type: "success",
                            message: "获取成功"
                        });
                        this.loading=false;
                    }else{
                        this.$message({
                            type: "error",
                            message: "查询失败"
                        });
                    }
                })
            },
            change:function (page) {
                this.getData(page);
            }
        },
        mounted(){
            this.getData();
        }

    }
</script>

<style scoped>

</style>