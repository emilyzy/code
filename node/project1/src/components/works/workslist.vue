<template>
    <basic-layout index="workslist">
        <el-form :inline="true" class="demo-form-inline" :model="form" :rules="rules" ref="search">
            <el-form-item label="标题" prop="workName">
                <el-input v-model="form.workName" placeholder="请输入作品名称"></el-input>
            </el-form-item>
            <!--<el-form-item label="作者">
                <el-input v-model="author" placeholder="请输入作者"></el-input>
            </el-form-item>-->
            <el-form-item label="查询类型" prop="type">
                <el-select v-model="form.type" placeholder="类型">
                    <el-option label="UI" value="UI"></el-option>
                    <el-option label="全栈" value="WEB"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submit">查询</el-button>
            </el-form-item>
        </el-form>
        <el-table
                :data="tableData"
                stripe
                style="width: 100%">
            <el-table-column
                    sortable
                    prop="workName"
                    label="作品名称"
                    width="180">
            </el-table-column>
            <el-table-column
                    sortable
                    prop="realname"
                    label="作者"
                    width="180">
            </el-table-column>
            <el-table-column
                    sortable
                    prop="type"
                    label="作品类型"
                    width="180">
            </el-table-column>
            <el-table-column
                    sortable
                    prop="publicDate"
                    label="发布时间"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="审核状态"
                    width="180">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="120">
                <template slot-scope="scope">
                    <el-button type="primary" plain v-if="scope.row.state==='未审核'" @click="auditwork(scope.row)">点击审核
                    </el-button>
                    <el-button type="success" plain v-if="scope.row.state==='通过'">
                        <a :href="scope.row.src" target="_blank">查看作品</a></el-button>
                    <el-button type="warning" plain v-if="scope.row.state==='未通过'" @click="auditwork(scope.row)">重新审核
                    </el-button>
                </template>
            </el-table-column>

        </el-table>
        <el-row type="flex" justify="center" style="margin-top:30px">
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="total"
                    :page-size="2"
                    :current-page.sync="now"
                    @current-change="change"
            >
            </el-pagination>
        </el-row>
        <el-dialog
                title="审核作品"
                :visible.sync="dialogVisible"
                width="30%"

        >
            <a :href="obj.src" target="_blank">作品链接>></a>
            <div><span>审核结果   :</span>
                <el-select v-model="value" placeholder="请选择">
                    <el-option
                            v-for="item in options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                    </el-option>
                </el-select>

            </div>

            <span slot="footer" class="dialog-footer">
    <el-button @click="dialogVisible = false">取 消</el-button>
    <el-button type="primary" @click="changeState">确 定</el-button>
  </span>
        </el-dialog>
    </basic-layout>
</template>

<script>
    import Layout from '../basicLayout'

    export default {
        name: "workslist",
        components: {
            "basic-layout": Layout,
        },
        data() {
            return {
                tableData: [],
                dialogVisible: false,
                obj: {},
                options: [{
                    value: 'pass',
                    label: '通过'
                }, {
                    value: 'fail',
                    label: '未通过'
                }],
                value: "",
                author: "",
                total: 0,
                form: {
                    workName: "",
                    type: ""
                },
                rules: {
                    workName: [
                        {required: true, message: "请输入作品名称", trigger: "blur"},
                    ],
                    type: [
                        {required: true, message: "请选择作品类型", trigger: "blur"},
                    ]
                },
                now: 1
            }
        },
        methods: {
            auditwork: function (obj) {
                this.obj = obj;
                this.dialogVisible = true;
            },
            changeState: function () {
                this.dialogVisible = false;
                if (this.value === "pass") {
                    this.$http.get("admin/auditingwork?state=pass&id=" + this.obj.id).then(res => {
                        if (res.data.data.message === "ok") {
                            this.$message({
                                type: "success",
                                message: "修改成功"
                            });
                            this.obj.state = "通过"
                        }
                    })
                } else if (this.value === "fail") {
                    this.$http.get("admin/auditingwork?state=fail&id=" + this.obj.id).then(res => {
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
            getData: function (page = 1) {
                this.$http.get(`admin/getWorks?workName=${this.form.workName}&type=${this.form.type}&p=${page}`).then(res => {
                    this.total = res.body.total;
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
                    this.loading = false;
                    this.tableData = data;
                    this.$message({
                        type: "success",
                        message: "查询成功"
                    })

                });
            },
            submit: function () {
                /*this.$refs.search.validate((valid)=>{
                 if(valid){
                 this.$http.get(`admin/getWorks?workName=${this.form.woekName}&type=${this.form.type}`).then(res => {
                 this.total=res.body.total;
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
                 })
                 }else{
                 return false;
                 }
                 })*/
                this.$refs.search.validate((valid) => {
                    if (valid) {
                        this.now = 1;
                        this.getData();
                    } else {
                        return false;
                    }
                });

            },
            change: function (page) {
                /*this.$http.get(`admin/getWorks?workName=${this.form.workName}&type=${this.form.type}&p=${page}`).then(res => {
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

                 });*/
                this.getData(page);
            }
        },
        mounted: function () {
            /*this.$http.get("admin/getWorks").then(res => {
             this.total=res.body.total;
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

             });*/
            this.getData();
        }

    }
</script>

<style scoped>

</style>