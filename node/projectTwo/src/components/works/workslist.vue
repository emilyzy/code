<template>
    <basic-layout index="1-1">
        <el-table
                :data="tableData"
                stripe
                class="table">
            <el-table-column
                    prop="workName"
                    label="作品名称"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="author"
                    label="作者"
                    width="180">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="120">
                <template slot-scope="scope">
                    <el-button type="success" plain v-if="scope.row.state==='未审核'">审核</el-button>
                    <el-button type="success"></el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-row type="flex" justify="center" style="margin-top: 30px;">
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :page-size="10"
                    :total="120">
            </el-pagination>
        </el-row>
    </basic-layout>
</template>

<script>
    import Layout from "../basicLayout"
    export default {
        name: "workslist",
        components:{
            "basic-layout":Layout
        },
        data() {
                return {
                    tableData:[]
                }
            },
        mounted:function(){
            /* let xhr=new XMLHttpRequest();
             xhr.open("get","https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getWorks");
             xhr.send();
             xhr.responseTypes="json";
             xhr.onload=function () {
                 let r=xhr.response;
             }*/
            this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getWorks").then(res=>{
                [{state:"pass"}]
                let data= res.data.data.map(v=>{
                    if(v.state==="pass"){
                        v.state="通过"
                    }else if(v.state==="failed"){
                        v.state="未通过"
                    }else {
                        v.state="未审核"
                    }
                    return v;
                });
                this.tableData=res.data.data;
                this.$message({
                    message:"查询成功",
                    type:"success"
                })
            })
        }
    }
</script>

<style scoped>

</style>