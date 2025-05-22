import { createRouter, createWebHistory } from 'vue-router'; 
import Home from '@/pages/Home.vue';
import Login from '@/components/login.vue'
import Posts from '@/components/Posts.vue';
import PostsAdd from '@/components/PostsAdd.vue';
import PostsView from '@/components/PostsView.vue';
import PostsEdit from '@/components/PostsEdit.vue';

const routes = [
    { 
        path: '/', 
        name: "home",
        component: Home
    },
    { 
        path: '/login', 
        name: "login", 
        component: Login
    },
    { 
        path: '/posts', 
        name: "posts", 
        component: Posts, 
        meta: { requiresAuth: true } 
    },
    { 
        path: '/posts/add', 
        name: "postsAdd", 
        component: PostsAdd, 
        meta: { requiresAuth: true } 
    },
    { 
        path: '/posts/:id', 
        name: "postsView", 
        component: PostsView, 
        meta: { requiresAuth: true } 
    },
    { 
        path: '/posts/edit/:id', 
        name: "postsEdit", 
        component: PostsEdit, 
        meta: { requiresAuth: true } 
    }
]

const router = createRouter({
    history: createWebHistory(), // Remove the base URL parameter
    routes
});

// Route Guard
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('user');

    if (to.meta.requiresAuth && !isAuthenticated) {
        next({ name: 'login' });
    } else {
        next();
    }
});

export default router;  