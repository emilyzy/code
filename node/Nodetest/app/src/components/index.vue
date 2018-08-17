<template>
    <basic-layout>
        <div id="main" style="width: 600px;height:400px;"></div>
    </basic-layout>
    <!--<script src="echarts.min.js"></script>-->

</template>

<script>

    import Layout from "./basicLayout";
    import echarts from "echarts"
    export default {
        name: "index",
        components: {
            "basic-layout": Layout
        },
        data(){
           return{
               count:{
                   users:20000,
                   company:12350,
                   works:42222,
                   videos:5000,
                   articles:3000,
               }



           }
        },
        mounted:function() {
            var myChart = echarts.init(document.getElementById('main'));
            var option = {
                color: ['#3398DB'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        data : ['用户', '作品', '视频', '视频', 'Fri', 'Sat', 'Sun'],
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'直接访问',
                        type:'bar',
                        barWidth: '60%',
                        data:[10, 52, 200, 334, 390, 330, 220]
                    }
                ]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);

    }}
</script>


<style scoped>

</style>