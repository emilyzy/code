<template>
    <BasicLayout index="1-3">
        <el-form :inline="true" :model="formInline" class="demo-form-inline">
            <el-form-item label="视频名称">
                <el-input v-model="formInline.user" placeholder="请输入名称"></el-input>
            </el-form-item>
            <el-form-item label="姓名">
                <el-input v-model="formInline.user" placeholder="请输入姓名"></el-input>
            </el-form-item>
            <el-form-item label="状态">
                <el-select v-model="formInline.region" placeholder="请选择状态">
                    <el-option label="通过" value="pass"></el-option>
                    <el-option label="未通过" value="failed"></el-option>
                    <el-option label="未审核" value="Unaudited"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">查询</el-button>
            </el-form-item>
        </el-form>
        <el-table
                :data="tableData"
                style="width: 100%;">
            <el-table-column
                    prop="author"
                    label="姓名"
                    width="150">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="名称"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="publicDate"
                    label="日期"
                    width="200">
            </el-table-column>
            <el-table-column
                    prop="type"
                    label="类型"
                    width="100">
            </el-table-column>
            <el-table-column
                    prop="state"
                    label="状态"
                    width="180">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="220">
                <template slot-scope="scope">
                    <!--{{scope.row}}-->
                    <el-button type="success" plain v-if="scope.row.state==='通过'" @click="details(scope.row)">查看详情</el-button>
                    <el-button type="info" plain v-else-if="scope.row.state==='未审核'" @click="reChecked(scope.row)">点击审核</el-button>
                    <el-button type="warning" plain v-else @click="reChecked(scope.row)">重新审核</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-row type="flex" justify="center" style="margin-top:30px;">
            <el-pagination
                    background
                    layout="prev, pager, next"
                    :total="1000">
            </el-pagination>
        </el-row>
        <el-dialog
                title="审核"
                :visible.sync="dialogVisible"
                width="30%">
            <a :href="obj.src" target="_blank">点击查看视频>></a>
            <div>
                <span>审核结果</span>
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
                <el-button type="primary" @click="updateItem">确 定</el-button>
            </span>
        </el-dialog>
        <el-dialog
                title="查看视频"
                :visible.sync="showVisible"
                width="30%">
            <a :href="obj.src" target="_blank">点击查看视频>></a>
            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="showVisible=false">确 定</el-button>
            </span>
        </el-dialog>
    </BasicLayout>
</template>

<script>
    import BasicLayout from './basicLayout'
    export default {
        name: "videolist",
        components: {
            BasicLayout
        },
        data() {
            return {
                tableData: [],
                dialogVisible: false,
                showVisible:false,
                obj: {},
                options: [
                    {
                        value: 'pass',
                        label: '通过'
                    },
                    {
                        value: 'failed',
                        label: '未通过'
                    }],
                value: '',                       //状态
                formInline: {
                    user: '',
                    region: ''
                }
            }
        },
        mounted: function () {
            this.$http.get('https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/getVideos').then(response => {
                let data = response.data.data.map(v => {
                    console.log(v);
                    if (v.state === 'pass') {
                        v.state = "通过";
                    }
                    else if (v.state === 'Unaudited') {
                        v.state = "未审核";
                    }
                    if (v.state === 'failed') {
                        v.state = "未通过";
                    }
                    return v;
                });
                this.tableData = data;
            });
        },
        methods: {
            reChecked: function (obj) {
                this.obj = obj;
                this.dialogVisible = true;
            },
            updateItem: function () {
                this.dialogVisible = false;
                if (this.value === 'pass') {
                    this.$http.get('https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/auditingvideo/pass?vid=' + this.obj.vid).then(response => {
                        if (response.data.data.message === 'ok') {
                            this.$message({
                                message: '修改成功',
                                type: 'success'
                            });
                        }
                        this.obj.state = "通过";
                    })
                }
                else if (this.value === 'failed') {
                    this.$http.get('https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/auditingvideo/fail?vid=' + this.obj.vid).then(response => {
                        if (response.data.data.message === 'ok') {
                            this.$message({
                                message: '修改成功',
                                type: 'success'
                            });
                        }
                        this.obj.state = "未通过";
                    })
                }
                this.value = "";
            },
            details:function (obj) {
                this.showVisible=true;
                this.obj = obj;
            },
            onSubmit() {
                console.log('submit!');
            }
        }
    }
</script>

<style scoped>

</style>