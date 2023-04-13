import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import { appData } from "../mixins/store";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta:{
        icon: 'mdi-package-variant',
        layout: 'GuestLayout',
        requiresAuth: false,
        portal: 'guest',
        topNav:{
            show: true,
            text: "Home",
            color: {
                default: 'black',
                hover: 'black'
            },  
            type: 'tile' ,
            class: {
                text: "white--text",
                hover:{
                    text: "orange--text"
                }
            }
        },
        footer: {
            show: true,
            text: "Home"
        }
    },
  },
  {
    path: '/example-1',
    name: 'Example 1',
    component: () => import(/* webpackChunkName: "guest-portal" */ '../views/Example1.vue'),
    meta:{
        icon: 'mdi-account-circle',
        layout: 'GuestLayout',
        requiresAuth: false,
        portal: 'guest',
        topNav:{
            show: true,
            text: "Example 1",
            color: {
                default: 'black',
                hover: 'black'
            },  
            type: 'tile' ,
            class: {
                text: "white--text",
                hover:{
                    text: "orange--text"
                }
            }
        },
        footer: {
            show: true,
            text: "Example 1"
        }
    },
  },
  {
    path: '/example-2',
    name: 'Example 2',
    component: () => import(/* webpackChunkName: "guest-portal" */ '../views/Example2.vue'),
    meta:{
        icon: 'mdi-account-circle',
        layout: 'GuestLayout',
        requiresAuth: false,
        portal: 'guest',
        topNav:{
            show: true,
            text: "Example 2",
            color: {
                default: 'black',
                hover: 'black'
            },  
            type: 'tile' ,
            class: {
                text: "white--text",
                hover:{
                    text: "orange--text"
                }
            }
        },
        footer: {
            show: true,
            text: "Example 2"
        }
    },
  },
  {
    path: '/example-3',
    name: 'Example 3',
    component: () => import(/* webpackChunkName: "guest-portal" */ '../views/Example3.vue'),
    meta:{
        icon: 'mdi-account-circle',
        layout: 'GuestLayout',
        requiresAuth: false,
        portal: 'guest',
        topNav:{
            show: true,
            text: "Example 3",
            color: {
                default: 'black',
                hover: 'black'
            },  
            type: 'tile' ,
            class: {
                text: "white--text",
                hover:{
                    text: "orange--text"
                }
            }
        },
        footer: {
            show: true,
            text: "Example 3"
        }
    },
  },
  {
    path: '/example-4',
    name: 'Example 4',
    component: () => import(/* webpackChunkName: "guest-portal" */ '../views/Example4.vue'),
    meta:{
        icon: 'mdi-account-circle',
        layout: 'GuestLayout',
        requiresAuth: false,
        portal: 'guest',
        topNav:{
            show: true,
            text: "Example 4",
            color: {
                default: 'black',
                hover: 'black'
            },  
            type: 'tile' ,
            class: {
                text: "white--text",
                hover:{
                    text: "orange--text"
                }
            }
        },
        footer: {
            show: true,
            text: "Example 4"
        }
    },
  },
  {
    path: '/example-5',
    name: 'Example 5',
    component: () => import(/* webpackChunkName: "guest-portal" */ '../views/Example5.vue'),
    meta:{
        icon: 'mdi-account-circle',
        layout: 'GuestLayout',
        requiresAuth: false,
        portal: 'guest',
        topNav:{
            show: true,
            text: "Example 5",
            color: {
                default: 'black',
                hover: 'black'
            },  
            type: 'tile' ,
            class: {
                text: "white--text",
                hover:{
                    text: "orange--text"
                }
            }
        },
        footer: {
            show: true,
            text: "Example5"
        }
    },
  },
]

const router = new VueRouter({
    mode: 'history',
    routes: routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { top: 0 }
        }
    }
})

router.beforeEach(async (to, from, next) => {  
    appData.setMainLoader(true)
    appData.setLayout("GuestLayout")
    next()
    return;
});

export default router
