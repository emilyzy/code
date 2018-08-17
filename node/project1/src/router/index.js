import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/index'
import WorksList from '@/components/works/workslist'
import ArticleList from '@/components/article/articlelist'
import ResumeList from '@/components/resume/resumelist'
import VideosList from '@/components/videos/videoslist'
import UserList from '@/components/user/userlist'
import UserShow from '@/components/user/usershow'
import CompanyReal from '@/components/company/companyReal'
import CompanyRealShow from '@/components/company/companyRealshow'
import RecruitmentList from '@/components/recruitment/recruitmentlist'
import InterviewList from '@/components/interview/interviewlist'
import InterviewShow from '@/components/interview/interviewshow'
import Test from "@/demo/test"
Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index
        },
        {
            path: '/workslist',
            name: 'workslist',
            component: WorksList

        },{
            path: '/articlelist',
            name: 'articlelist',
            component: ArticleList
        },{
            path: '/videoslist',
            name: 'videoslist',
            component: VideosList
        },{
            path:"/recruitmentlist",
            name:'recruitmentlist',
            component:RecruitmentList
        },{
            path:"/resumelist",
            name:'resumelist',
            component:ResumeList
        },{
            path:"/userlist",
            name:'userlist',
            component:UserList
        },{
            path:"/usershow/:id",
            name:'usershow',
            component:UserShow
        }
        ,{
            path:"/companyReal",
            name:'companyReal',
            component:CompanyReal
        },{
            path:"/companyRealshow/:id",
            name:'companyRealshow',
            component:CompanyRealShow
        }
        ,{
            path:"/interviewlist",
            name:'interviewlist',
            component:InterviewList
        },{
            path:"/interviewshow/:id",
            name:'interviewshow',
            component:InterviewShow
        }





        ,{
            path:"/test",
            name:"test",
            component:Test
        }

    ]
})
