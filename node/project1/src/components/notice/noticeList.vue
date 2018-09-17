<template>
    <basic-layout index="noticeList">
        <el-table
                :data="tableData"
                :stripe="true"
                :border="true"
                v-loading="loading"
                style="width: 100%">
            <el-table-column
                    align="center"
                    prop="id"
                    label="id"
                    :sortable="true"
                    >
            </el-table-column>
            <el-table-column
                    align="center"
                    label="内容"
                    prop="content"
                    :show-overflow-tooltip="true"
                    >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="date"
                    label="日期"
            >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="sort"
                    label="排序"
                    :sortable="true"
            >
            </el-table-column>
            <el-table-column
                    width="200"
                    align="center"
                    label="操作">
                <template slot-scope="scope">
                    <el-button type="primary"  plain><router-link :to="{path:'/noticeUpdate/'+scope.row.id}">编辑</router-link></el-button>
                    <el-button type="danger"  plain @click="del(scope.row.id)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
    </basic-layout>

</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "noticeList",
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
                        this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/delNotice?id="+id).then(res=>{
                       if(res.body.data.message==="ok"){
                           this.$message({
                               type: 'success',
                               message: '删除成功!'
                           });
                           this.tableData=this.tableData.filter(ele=>ele.id!==id);
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
            this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getNotices").then(res=> {
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