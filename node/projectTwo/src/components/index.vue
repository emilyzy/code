<template>
    <basic-layout index="index">
        <div id="main" style="width: 600px;height:400px;"></div>
    </basic-layout>

</template>

<script>
    import Layout from "./basicLayout";
    import echarts from "echarts";
    export default {
        name: "index",
        data(){
            return{
                count:{
                    a:100,
                    b:200,
                    c:300,
                    d:400,
                    e:500,
                    f:600,
                    g:700
                }
            }
        },
        components:{
            "basic-layout":Layout
        },
        mounted:function () {
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('main'));
            var data=this.count;
            // 指定图表的配置项和数据
            var option = {
                title: {
                    text: '销量统计表'
                },
                tooltip: {},
                legend: {
                    data:['销量']
                },
                xAxis: {
                    data: ["a","b","c","d","e","f","g"]
                },
                yAxis: {},
                series: [{
                    name: '销量',
                    type: 'bar',
                    data: [data.a, data.b,data.c,data.d,data.e,data.f,data.g]
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }/*,
        data(){
            return{
                eData:{}
            }
        }*/
    }
</script>

<style scoped>

</style>