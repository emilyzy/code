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
                    <el-button type="success" v-if="scope.row.state==='通过'" plain @click="show(scope.row)">查看信息</el-button>
                    <el-button type="primary" v-else-if="scope.row.state==='未审核'" @click="audit(scope.row)" plain>点击审核</el-button>
                    <el-button type="warning" v-else="scope.row.state==='未通过'" @click="audit(scope.row)" plain>重新审核</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-row type="flex" justify="center" style="margin-top:30px">
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="total"
                    :current-page.sync="now"
                    @current-change="change"
                    :page-size="2"
            >
            </el-pagination>
        </el-row>
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
    <el-button type="primary" @click="changeState">确 定</el-button>
  </span>
        </el-dialog>
        <el-dialog
                title="查看信息"
                :visible.sync="showRecruitment"
                width="50%">
            <div>
                <div class="description">{{obj.description}}</div>
            </div>
            <span slot="footer" class="dialog-footer">
    <el-button type="primary" @click="showRecruitment = false">确 定</el-button>
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
                    value: 'fail',
                    label: '未通过'
                }],
                value: "",
                showRecruitment:false,
                description:"",
                now:1,
                total:0
            }
        },
        methods:{
            audit:function (obj) {
              this.obj=obj;
              this.dialogVisible=true;
          },
            changeState: function () {
                this.dialogVisible = false;
                if (this.value === "pass") {
                    this.$http.get("admin/auditingRecruitment?state=pass&rid=" + this.obj.rid).then(res => {
                        if (res.data.data.message === "ok") {
                            this.$message({
                                type: "success",
                                message: "修改成功"
                            });
                            this.obj.state = "通过"
                        }
                    })
                } else if (this.value === "fail") {
                    this.$http.get("admin/auditingRecruitment/?state=fail&rid=" + this.obj.rid).then(res => {
                        if (res.data.data.message === "ok") {
                            this.$message({
                                type: "success",
                                message: "修改成功"
                            });
                            this.obj.state = "未通过"
                        }
                    })
                }
                this.auditState = "";
            },
            show: function (obj) {
                this.showRecruitment = true;
                this.obj = obj;
            },
            change: function (page) {
                this.$http.get(`admin/getRecruitment?p=${page}`).then(res => {
                 let data = res.data.data.map(v => {
                 if (v.state === "pass") {
                 v.state = "通过"
                 } else if (v.state === "fail") {
                 v.state = "未通过"
                 } else if (v.state === "Unaudited") {
                 v.state = "未审核"
                 }
                 return v;
                 });

                 this.tableData = data;
                 this.$message({
                 type: "success",
                 message: "查询成功"
                 })

                 });
            },
        },

        mounted:function (){
            this.$http.get('admin/getRecruitment').then(res => {
                this.total = res.body.total;
                let data = res.data.data.map(v => {

                    if (v.state === "pass") {
                        v.state = "通过"
                    } else if (v.state === "fail") {
                        v.state = "未通过"
                    } else if (v.state == "Unaudited") {
                        v.state = "未审核"
                    }
                    return v;
                });
                this.tableData = data;
                this.$message({
                    type: "success",
                    message: "查询成功"
                })
            })
        }
    }
</script>

<style scoped>

</style>