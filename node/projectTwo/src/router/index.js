import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/index'
import WorksList from '@/components/works/workslist'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index
        },{
            path: "/worklist",
            name:"worklist",
            component:WorksList
        }
    ]
})