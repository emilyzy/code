<template>
    <basic-layout index="interviewlist">
        <el-table
                :data="tableData"
                :stripe="true"
                :border="true"
                v-loading="loading"
                style="width: 100%">
            <el-table-column
                    align="center"
                    prop="id"
                    label="ID"
                    >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="uid"
                    label="用户ID"
            >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="cid"
                    label="企业ID"
            >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="state"
                    label="面试状态"
                    >
            </el-table-column>

            <el-table-column
                    width="200"
                    align="center"
                    label="查看">
                <template slot-scope="scope">
                    <el-button type="success"  plain ><router-link :to="{path:'/interviewshow/'+scope.row.id}">查看</router-link></el-button>
                </template>
            </el-table-column>
        </el-table>
    </basic-layout>

</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "interviewlist",
        components:{
            "basic-layout":basicLayout
        },
        data() {
            return {
                tableData: [],
                loading:true
            }
        }/*,
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
        }*/,
        mounted() {
            this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getInterviews").then(res=> {
                if (res.status === 200) {
                    let data = res.body.data;
                    data=data.map(ele=>{
                    let state="";
                    switch (ele.state){
                        case "1":state="已发送";break;
                        case "2":state="已接受";break;
                        case "3":state="已查看";break;
                        case "4":state="已笔试";break;
                        case "5":state="已查看笔试结果";break;
                        case "6":state="已进行面试通知";break;
                        case "7":state="不合适";break;
                        case "8":state="成功通过";break;
                        }
                        ele.state=state;
                        return ele;
                    });
                    this.tableData=data;
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