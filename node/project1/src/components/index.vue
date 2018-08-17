<template>
    <basic-layout index="index">
        <el-row>
            <el-col :span="13">
                <div id="main" style="width: 600px;height:400px;" ref="form1"></div>
            </el-col>
            <el-col :span="11">
                <div>
                    <ul>
                        <li>待审核作品数量: <span>{{todo.works}}</span><router-link to="#" class="deal">快速处理</router-link></li>
                        <li>待审核文章数量: <span>{{todo.articles}}</span><router-link to="#" class="deal">快速处理</router-link></li>
                        <li>待审核视频数量: <span>{{todo.video}}</span><router-link to="#" class="deal">快速处理</router-link></li>
                        <li>待审核简历数量: <span>{{todo.resume}}</span><router-link to="#" class="deal">快速处理</router-link></li>
                        <li>待审核招聘数量: <span>{{todo.recruitment}}</span><router-link to="#" class="deal">快速处理</router-link></li>
                        <li>待审核企业数量: <span>{{todo.company}}</span><router-link to="#" class="deal">快速处理</router-link></li>

                    </ul>
                </div>
            </el-col>
        </el-row>
    </basic-layout>
</template>


<script>
    import Layout from "./basicLayout"
    import echarts from "echarts"

    export default {
        name: "index",
        components: {
            "basic-layout": Layout,
        },
        data() {
            return {
                count: {},
                todo:{}
            }
        },
        methods:{
          createEcharts(){
              let myChart = echarts.init(this.$refs.form1);
              let data=this.count;
              let option = {
                  color: ['#3398DB'],
                  tooltip: {
                      trigger: 'axis',
                      axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                          type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                      }
                  },
                  grid: {
                      left: '3%',
                      right: '4%',
                      bottom: '3%',
                      containLabel: true
                  },
                  xAxis: [
                      {
                          type: 'category',
                          data: ['用户数量', '企业数量', '作品数量', '文章数量', '视频数量', '简历数量', '招聘信息'],
                          axisTick: {
                              alignWithLabel: true
                          }
                      }
                  ],
                  yAxis: [
                      {
                          type: 'value'
                      }
                  ],
                  series: [
                      {
                          name: '数量',
                          type: 'bar',
                          barWidth: '60%',
                          data: [data.users, data.company, data.works, data.articles, data.videos, data.resume, data.recruitment]
                      }
                  ]
              };

              myChart.setOption(option);
          }
        },
        mounted: function () {
            this.$http.get("https://www.easy-mock.com/mock/5b18ad9ec6b9b923a614ec23/project/count").then(res=>{
                this.count=res.body.data.total;
                this.todo=res.body.data.todo;
                this.$message({
                    type:"success",
                    message:"确认"
                });
                this.createEcharts();
            })
        }
    }

</script>

<style scoped>
    ul li{
        line-height: 30px;
        list-style: none;
    }
    .deal{
        margin-left:20px;
    }
</style>