import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import(/* webpackChunkName: "test" */ '../../pages/Home.vue'),
        meta: {
            order: 0,
        }
    },
    {
        path: '/register',
        name: '[IF] Register User',
        component: () => import(/* webpackChunkName: "test1" */ '../../pages/Test1.vue'),
        meta: {
            order: 1,
        }
    },
    {
        path: '/login',
        name: '[IF] User Login',
        component: () => import(/* webpackChunkName: "test2" */ '../../pages/Test2.vue'),
        meta: {
            order: 21,
        }
    },
    {
        path: '/users',
        name: '[AF] User List',
        component: () => import(/* webpackChunkName: "test2" */ '../../pages/Test3.vue'),
        meta: {
            order: 3,
        }
    },
     {
        path: '/users/edit/:id',
        name: '[IF] User Edit',
        component: () => import(/* webpackChunkName: "test2" */ '../../pages/Test4.vue'),
        meta: {
            order: 4,
        }
    },
    {
        path: '/rest-data',
        name: '[AF] Reset Data',
        component: () => import(/* webpackChunkName: "test2" */ '../../pages/Test5.vue'),
        meta: {
            order: 5,
        }
    },
]
const router = createRouter({
    history: createWebHashHistory(),
    routes
})
export default router
