import Vue from 'vue'
import Router from 'vue-router'
// import HelloWorld from '@/components/HelloWorld'
// import Layout from '@/components/Layout'
// import Container from '@/components/container'

import basicLayout from '@/components/basicLayout'
import WorkList from '@/components/worklist'
import ArticleList from '@/components/articlelist'
import Index from "@/components/index"
import VideoList from "@/components/videolist"

Vue.use(Router)

export default new Router({
    routes: [
        // {
        //     path: '/',
        //     name: 'HelloWorld',
        //     component: HelloWorld
        // },
        // {
        //     path: '/Layout',
        //     name: 'Layout',
        //     component: Layout
        // },
        // {
        //     path: '/container',
        //     name: 'container',
        //     component: Container
        // },
        {
          path:"/",
            name:"Index",
            component:Index
        },
        {
            path:"/basicLayout",
            name:"basicLayout",
            component:basicLayout
        },
        {
            path:"/worklist",
            name:"worklist",
            component:WorkList
        },
        {
            path:"/articlelist",
            name:"articlelist",
            component:ArticleList
        },
        {
            path:"/videolist",
            name:"videolist",
            component:VideoList
        }
    ]
})

