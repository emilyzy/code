<template>
    <basic-layout index="articlelist">
        <el-form :inline="true" class="demo-form-inline" ref="search" :model="form" :rules="rules">
            <el-form-item label="标题" prop="title">
                <el-input v-model="form.title" placeholder="请输入标题"></el-input>
            </el-form-item>
            <el-form-item label="选择类型" prop="type">
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
                    prop="title"
                    label="标题"
                    width="180">
            </el-table-column>
            <el-table-column
                    sortable
                    prop="author"
                    label="作者"
                    width="150">
            </el-table-column>
            <el-table-column
                    sortable
                    prop="description"
                    label="摘要"
                    width="180">
            </el-table-column>
            <el-table-column
                    sortable
                    prop="type"
                    label="类型"
                    width="180">
            </el-table-column>
            <el-table-column
                    sortable
                    prop="publicDate"
                    label="发布日期"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="审核状态"
                    width="180">
            </el-table-column>
            <el-table-column
                    label="操作"
            >
                <template slot-scope="scope">
                    <el-button type="primary" plain v-if="scope.row.state==='未审核'" @click="auditarticle(scope.row)">
                        点击审核
                    </el-button>
                    <el-button type="success" plain v-if="scope.row.state==='通过'" @click="show(scope.row)">查看文章
                    </el-button>
                    <el-button type="warning" plain v-if="scope.row.state==='未通过'" @click="auditarticle(scope.row)">
                        重新审核
                    </el-button>
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
                title="审核文章"
                :visible.sync="dialogVisible"
                width="50%">
            <div>
                <div class="title">{{obj.title}}</div>
                <div class="content">{{obj.content}}</div>
            </div>
            <div>审核结果 :
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
        <el-dialog
                title="查看文章"
                :visible.sync="showArticle"
                width="50%">
            <div>
                <div class="title">{{obj.title}}</div>
                <div class="content">{{obj.content}}</div>
            </div>

            <span slot="footer" class="dialog-footer">
    <el-button type="primary" @click="showArticle = false">确 定</el-button>
  </span>
        </el-dialog>
    </basic-layout>
</template>

<script>
    import Layout from '../basicLayout'

    export default {
        name: "articlelist",
        components: {
            "basic-layout": Layout,
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
                showArticle: false,
                author: "",
                total: 0,
                form: {
                    title: "",
                    type: ""
                },
                rules: {
                    title: [
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
            auditarticle: function (obj) {
                this.dialogVisible = true;
                this.obj = obj;
            },
            changeState: function () {
                this.dialogVisible = false;
                if (this.value === "pass") {
                    this.$http.get("admin/auditingArticle?state=pass&aid=" + this.obj.aid).then(res => {
                        if (res.data.data.message === "ok") {
                            this.$message({
                                type: "success",
                                message: "修改成功"
                            });
                            this.obj.state = "通过"
                        }
                    })
                } else if (this.value === "fail") {
                    this.$http.get("admin/auditingArticle/?state=fail&aid=" + this.obj.aid).then(res => {
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
                this.showArticle = true;
                this.obj = obj;
            },
            getData: function (page = 1) {
                this.$http.get(`admin/getArticles?title=${this.form.title}&type=${this.form.type}&p=${page}`).then(res => {
                    /*if (res.body.state === "ok") {*/
                    this.total = res.body.total;
                    let data = res.data.data.map(v => {
                        if (v.title.length > 10) {
                            v.title = v.title.slice(0, 10);
                            v.title += "..."
                        }
                        if (v.description.length > 10) {
                            v.description = v.description.slice(0, 30);
                            v.description += "..."
                        }
                        if (v.state === "pass") {
                            v.state = "通过"
                        } else if (v.state === "fail") {
                            v.state = "未通过"
                        } else if (v.state == "Unaudited") {
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
                    /*} else {
                     this.$message({
                     type: "error",
                     message: "查询失败"
                     })
                     }*/
                })
            },
            change: function (page) {
                this.getData(page);
            },
            submit: function () {
                this.$refs.search.validate((valid) => {
                    if (valid) {
                        this.now = 1;
                        this.getData();
                    } else {
                        return false;
                    }
                });
            }
        },
        mounted: function () {
            this.getData();
        }
    }
</script>

<style scoped>
    .title {
        text-align: center;
    }

    .content {
        line-height: 22px;
    }
</style>