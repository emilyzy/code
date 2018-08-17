<template>
    <basic-layout index="1-2">
        <el-table
                :data="tableData"
                stripe
                class="table"
                style="width: 100%">
            <el-table-column
                    prop="title"
                    label="标题"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="author"
                    label="作者"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="description"
                    label="摘要">
            </el-table-column>
            <el-table-column
                    prop="publicDate"
                    label="发布日期">
            </el-table-column>
            <el-table-column
                    prop="type"
                    label="类型">
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="审核状态">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="120">
                <template slot-scope="scope">
                    <el-button type="primary" plain>审核</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
                background
                layout="prev, pager, next"
                :total="1000">
        </el-pagination>
    </basic-layout>
</template>

<script>
    import Layout from "./basicLayout"

    export default {
        name: "articlelist",
        components: {
            "basic-layout": Layout
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
                    value: 'failed',
                    label: '未通过'
                }],
                value: ''
            }
        },
        mounted: function () {
            this.$http.get('https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getArticles').then(res => {
                [{state: "pass"}, {}]
                let data = res.body.data.map(v => {
                    if (v.state === "pass") {
                        v.state = "通过"
                    } else if (v.state === "failed") {
                        v.state = "未通过"
                    } else
                        return v;
                })
                if (res.ok) {
                    this.tableData = response.body.data;
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