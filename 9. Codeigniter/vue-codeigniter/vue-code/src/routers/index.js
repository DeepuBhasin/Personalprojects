import {createRouter, createWebHashHistory} from 'vue-router';
import LoginPage from '@/pages/LoginPage.vue';

const routes = [
    {
        path : '/', 
        component : LoginPage,
        children : [
            {
                path : '/',
                name : 'login',
                component : async()=> await import("@/components/logincomponents/LoginForm") 
            },
            {
                path : 'signup',
                name : 'signup',
                component : async()=> await import("@/components/logincomponents/SignUpForm") 
            }

        ]
    },
    {
        path : "/dashboard",
        component : async ()=> await import('@/pages/AppLayout.vue'),
        children : [
            {
                path : '/dashboard',
                name : 'dashboard',
                component : async()=> await import("@/components/applayout/DashboardComponent") 
            },
            {
                path : 'myprofile',
                name : 'myprofile',
                component : async()=> await import("@/components/applayout/MyProfileComponent") 
            },
            {
                path : 'searchuser',
                name : 'searchuser',
                component : async()=> await import("@/components/applayout/SearchUserComponent") 
            },
            {
                path : 'viewuser/:id?',
                name : 'viewuser',
                component : async()=> await import("@/components/applayout/ViewUserComponent") 
            },
        ]
    },
    {
        path: "/:url(.*)",
        name: "notfound",
        component : async()=> await import("@/pages/NotFoundPage.vue")
    }
];

const router = createRouter({
    history : createWebHashHistory(),
    routes
});

export default router;
