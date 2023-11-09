import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import(/* webpackChunkName: "home" */ '../../pages/Home.vue'),
        meta: {
            order: 0,
        }
    },
    {
        path: '/example/inputform-load-simple',
        name: '[IF] Basic - SERVER',
        component: () => import(/* webpackChunkName: "InputForm-Load-Simple" */ '../../pages/InputForm-Load-Simple.vue'),
        meta: {
            order: 1,
        }
    },
    {
        path: '/example/inputform-pass-basic',
        name: '[IF] Basic - Local',
        component: () => import(/* webpackChunkName: "InputForm-Pass-Basic" */ '../../pages/InputForm-Pass-Basic.vue'),
        meta: {
            order: 1,
        }
    },
    {
        path: '/example/inputform-load-complex',
        name: '[IF] Complex - SERVER',
        component: () => import(/* webpackChunkName: "InputForm-Load-Complex" */ '../../pages/InputForm-Load-Complex.vue'),
        meta: {
            order: 2,
        }
    },
    {
        path: '/example/inputform-load-masking',
        name: '[IF] Masking - SERVER',
        component: () => import(/* webpackChunkName: "InputForm-Load-Masking" */ '../../pages/InputForm-Load-Masking.vue'),
        meta: {
            order: 3,
        }
    },
    {
        path: '/example/inputform-load-linear',
        name: '[IF] Linear Loader - SERVER',
        component: () => import(/* webpackChunkName: "InputForm-Load-Linear" */ '../../pages/InputForm-Load-Linear.vue'),
        meta: {
            order: 3,
        }
    },
    {
        path: '/example/actionform-load-icons',
        name: '[AF] Icons - SERVER',
        component: () => import(/* webpackChunkName: "ActionForm-Load-Icons" */ '../../pages/ActionForm-Load-Icons.vue'),
        meta: {
            order: 4,
        }
    },
    {
        path: '/example/actionform-load-buttons',
        name: '[AF] Buttons - SERVER',
        component: () => import(/* webpackChunkName: "ActionForm-Load-Buttons" */ '../../pages/ActionForm-Load-Buttons.vue'),
        meta: {
            order: 5,
        }
    },
    {
        path: '/example/load-multi-forms',
        name: '[MF] Load Multiple Forms',
        component: () => import(/* webpackChunkName: "LoadMultiForms" */ '../../pages/LoadMultiForms.vue'),
        meta: {
            order: 7,
        }
    }
]
const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router