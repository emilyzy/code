<template>
    <basic-layout index="recruitmentlist">
        <el-table
                :data="tableData"
                :stripe="true"
                :border="true"
                style="width: 100%">
            <el-table-column
                    align="center"
                    prop="rid"
                    label="招聘信息id"
                    width="110">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="cid"
                    label="企业id"
                    width="80">
            </el-table-column>
            <el-table-column
                    prop="description"
                    label="描述"
                    :show-overflow-tooltip="true"
                    width="480">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="location"
                    label="地址"
                    width="200">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="number"
                    label="招聘人数"
                    width="80">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="publicDate"
                    label="发布日期"
                    width="180">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="state"
                    label="审核状态"
                    width="180">
            </el-table-column>
            <el-table-column
                    align="center"
                    width="200"
                    label="操作">
                <template slot-scope="scope">
                    <el-button type="success" v-if="scope.row.state==='通过'" plain ><a href="#" target="_blank"></a>查看信息</el-button>
                    <el-button type="primary" v-else-if="scope.row.state==='未审核'" @click="audit(scope.row)" plain>点击审核</el-button>
                    <el-button type="warning" v-else="scope.row.state==='未通过'" @click="audit(scope.row)" plain>重新审核</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-dialog
                title="提示"
                :visible.sync="dialogVisible"
                width="30%"
                >
            <div>
                {{obj.description}}
            </div>
            <el-select v-model="value" placeholder="请选择">
                <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                </el-option>
            </el-select>
            <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">取 消</el-button>
    <el-button type="primary" @click="submit">确 定</el-button>
  </span>
        </el-dialog>
    </basic-layout>

</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "recruitmentlist",
        components:{
            "basic-layout":basicLayout
        },
        data() {
            return {
                tableData: [],
                obj: {},
                dialogVisible: false,
                options: [{
                    value: 'pass',
                    label: '通过'
                }, {
                    value: 'failed',
                    label: '未通过'
                }],
                value: "",
                showArticle:false,
                title:"",
                type:"",
                author:"",
            }
        },
        methods:{
            audit:function (obj) {
              this.obj=obj;
              this.dialogVisible=true;
          },
            submit(){
                this.dialogVisible=false;
                if(this.value==="pass"){
                    this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/auditingRecruitment/pass").then(res=>{
                        if(res.body.state==="ok"){
                            this.$message({
                                type:"success",
                                message:"修改成功"
                            });
                            this.obj.state="通过";
                        }
                    })
                }else if(this.value==="failed"){
                    this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/auditingRecruitment/fail").then(res=>{
                        if(res.body.state==="ok"){
                            this.$message({
                                type:"success",
                                message:"修改成功"
                            });
                            this.obj.state="未通过";
                        }
                    })
                }
                /*this.obj.state=this.value;*/
            }
        },

        mounted() {
            this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getRecruitment").then(res=> {
                if (res.status === 200) {
                    let data = res.data.data.map(v => {
                        if (v.state === "pass") {
                            v.state = "通过"
                        } else if (v.state === "failed") {
                            v.state = "未通过"
                        } else if (v.state === "unaudited") {
                            v.state = "未审核"
                        }
                        return v;
                    });
                    /*this.tableData = data;*/
                    this.tableData = res.body.data;
                    this.$message({
                        message: "查询成功",
                        type: "success"
                    })
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