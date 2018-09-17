<template>
    <basic-layout index="resumelist">
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
                    prop="position"
                    label="求职意向"
                    width="120">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="name"
                    label="姓名"
                    width="110">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="sex"
                    label="性别"
                    width="50">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="exp"
                    label="经验"
                    width="110">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="record"
                    label="学历"
                    width="110">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="nowposition"
                    label="现职位"
                    width="180">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="publicDate"
                    label="简历上传时间"
                    >
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="resume"
                    label="查看简历"
                    width="180">
            </el-table-column>
            <el-table-column
                    align="center"
                    prop="state"
                    label="当前状态"
                    width="110">
            </el-table-column>
            <el-table-column
                    align="center"
                    width="130"
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
                :visible.sync="showResume"
                width="50%">
            <div>
                <div class="description">{{obj.exp}}</div>
            </div>
            <span slot="footer" class="dialog-footer">
    <el-button type="primary" @click="showResume = false">确 定</el-button>
  </span>
        </el-dialog>
    </basic-layout>

</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "resumelist",
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
                showResume:false,
                exp:"",
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
                    this.$http.get("admin/auditingResume?state=pass&rid=" + this.obj.rid).then(res => {
                        if (res.data.data.message === "ok") {
                            this.$message({
                                type: "success",
                                message: "修改成功"
                            });
                            this.obj.state = "通过"
                        }
                    })
                } else if (this.value === "fail") {
                    this.$http.get("admin/auditingResume/?state=fail&rid=" + this.obj.rid).then(res => {
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
                this.showResume = true;
                this.obj = obj;
            },
            change: function (page) {
                this.$http.get(`admin/getResume?p=${page}`).then(res => {
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

        mounted() {
            this.$http.get('admin/getResume').then(res => {
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