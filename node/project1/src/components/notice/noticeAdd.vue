<template>
    <basic-layout index="noticeAdd">
        <el-col :span="12">
        <el-form ref="form" :model="form" label-width="100px" :rules="rules">
            <el-form-item label="内容" prop="content">
                <el-input
                        type="textarea"
                        :rows="3"
                        placeholder="请输入内容"
                        v-model="form.content"
                >
                </el-input>
            </el-form-item>
            <el-form-item label="排序" prop="sort">
                <el-input
                        placeholder="请输入排序"
                        v-model.number="form.sort"
                >
                </el-input>
            </el-form-item>
            <el-form-item label="日期" prop="date">
                <el-date-picker
                    v-model="form.date"
                    placeholder="选择日期"
                    type="date">
                </el-date-picker>
            </el-form-item>


            <el-form-item>
                <el-button type="primary" @click="onSubmit" >立即添加</el-button>
            </el-form-item>
        </el-form>
        </el-col>
    </basic-layout>

</template>

<script>
    import basicLayout from "../basicLayout";
    export default {
        name: "noticeAdd",
        components:{
            "basic-layout":basicLayout
        },
        data() {
            return {
                form:{
                    sort:"",
                    content:"",
                    date:"",
                    id:""
                },
                rules:{
                    content:[
                        {
                            required:true,
                            message:"请填写公告内容",
                            trigger:"blur"
                        }
                    ],
                    sort:[
                        {
                            required:true,
                            message:"请填写排序数字",
                            trigger:"blur"
                        },{
                            type:"number",
                            message:"请填写数字",
                            trigger:"blur"
                        }
                    ],
                    date:[
                        {
                            required:true,
                            message:"请填写日期",
                            trigger:"blur"
                        }
                    ]
                }
            }
        },
        methods:{
            onSubmit(){
                this.$refs.form.validate((valid)=>{
                    if(valid){
                        this.form.id=this.$route.params.id;
                        this.$http.post("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/addNotice",this.form).then(res => {
                            if(res.body.data.message==="ok") {
                                this.$message({
                                    type: 'success',
                                    message: '添加成功!'
                                });
                                this.$router.push({path:'/noticeList'})
                            }
                        })
                    }else{
                        this.$message({
                            type: 'error',
                            message: '验证失败'
                        });
                        return false;
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>