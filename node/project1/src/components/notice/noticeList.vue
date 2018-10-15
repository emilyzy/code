<template>
    <basic-layout index="noticeList">
        <el-table
                :data="tableData"
                :border="true"
                v-loading="loading"
                style="width: 100%"
        >
            <el-table-column
                    :sortable="true"
                    align="center"
                    prop="id"
                    label="id"
                    width="180">
            </el-table-column>
            <el-table-column
                    :sortable="true"
                    align="center"
                    prop="content"
                    label="内容"
                    :show-overflow-tooltip="true"
            >
            </el-table-column>
            <el-table-column
                    :sortable="true"
                    align="center"
                    prop="date"
                    label="日期"
                    width="180">
            </el-table-column>
            <el-table-column
                    :sortable="true"
                    align="center"
                    prop="sort"
                    label="排序"
            >
            </el-table-column>
            <el-table-column
                    align="center"
                    label="操作"
            >
                <template slot-scope="scope">
                    <el-button type="success" :plain="true">
                        <router-link :to="{path:'/noticeupdate/'+scope.row.id}">编辑</router-link>
                    </el-button>
                    <el-button type="danger" :plain="true" @click="del(scope.row.id)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-row type="flex" justify="center" style="margin-top: 30px">
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="total"
                    :page-size="2"
                    @current-change="change"
            >
            </el-pagination>
        </el-row>
    </basic-layout>
</template>



<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "noticeList",
        components:{
            "basic-layout":basicLayout
        },
        data(){
            return {
                tableData:[],
                loading:true,
                total:1
            }
        },
        methods:{
            del(id){
                this.$confirm('确定删除吗?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete("admin/notices/"+id).then(res => {
                        if(res.body === "ok"){
                            this.$message({
                                type: 'success',
                                message: '删除成功!'
                            });
                            this.tableData=this.tableData.filter(ele=>ele.id!==id)
                        }else{
                            this.$message({
                                type: 'error',
                                message: '删除失败!'
                            });
                        }
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            getData:function (page=1) {
                this.$http.get("admin/notices?p="+page).then(res => {
                    if (res.status === 200) {
                        this.total=res.body.total;
                        this.tableData=res.body.data;
                        this.$message({
                            message:"获取成功",
                            type:"success"
                        });
                        this.loading=false;
                    }
                })
            },
            change:function(page){
                this.getData(page);
            }
        },
        mounted: function () {
            this.getData();
        }
    }
</script>

<style scoped>

</style>