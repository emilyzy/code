<template>
    <basic-layout index="userlist">
        <el-table
                :data="tableData"
                :stripe="true"
                :border="true"
                v-loading="loading"
                style="width: 100%">
            <el-table-column
                    align="center"
                    prop="nickName"
                    label="昵称"
                    >
            </el-table-column>
            <el-table-column
                    align="center"
                    label="头像"
                    prop="avatar"
                    >
                <template slot-scope="scope">
                    <img :src="scope.row.avatar" alt="" style="height: 50px; width: 50px; border-radius: 50%; background:no-repeat center/100% auto">
                </template>
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="realmame"
                    label="真实姓名"
            >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="age"
                    label="年龄"
            >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="workState"
                    label="求职状态"
                    width="200"
                    >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="targetPosition"
                    label="目标职位"
                    >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="targetSalary"
                    label="目标薪资"
            >
            </el-table-column>
            <el-table-column
                    width="200"
                    align="center"
                    label="操作">
                <template slot-scope="scope">
                    <el-button type="primary"  plain ><router-link :to="{path:'/usershow/'+scope.row.uid}">查看</router-link></el-button>
                    <el-button type="danger"  plain @click="del(scope.row.uid)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
    </basic-layout>

</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "userlist",
        components:{
            "basic-layout":basicLayout
        },
        data() {
            return {
                tableData: [],
                loading:true
            }
        },
        methods:{
            del(id){

                    this.$confirm('此操作将永久删除该用户, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/delUser?id="+id).then(res=>{
                       if(res.body.data.state==="success"){
                           this.$message({
                               type: 'success',
                               message: '删除成功!'
                           });
                           this.tableData=this.tableData.filter(ele=>ele.uid!==id);
                       }else{
                           this.$message({
                               type: 'error',
                               message: '删除失败'
                           });
                       }
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: '已取消删除'
                        });
                    });
                    })
                }
        },
        mounted() {
            this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getUsers").then(res=> {
                if (res.status === 200) {
                    this.tableData = res.body.data;
                    this.$message({
                        message: "查询成功",
                        type: "success"
                    });
                    this.loading=false;
                } else {
                    this.$message({
                        message: "查询失败",
                        type: "error"
                    })
                }
            })
        }
    }
</script>

<style scoped>

</style>