import Vue from 'vue'
import Router from 'vue-router'
import layout from '@/components/layout'
import container from '@/components/container'
import menu from '@/components/menu'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/layout',
            name: 'layout',
            component: layout
        },
        {
            path: '/container',
            name: 'container',
            component: container
        },
        {
            path: '/menu',
            component: menu
        }
    ]
})