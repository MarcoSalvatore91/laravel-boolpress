import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/pages/Home.vue'
import Contacts from './components/pages/Contacts.vue'
import NotFoundPage from './components/pages/NotFoundPage.vue'
import SinglePost from './components/pages/SinglePost.vue'

const router = new VueRouter({
    
    mode: 'history',
    linkExactActiveClassk: 'active',

    routes: [
        {path: '/', component: Home, name: 'home'},
        {path: '/contacts', component: Contacts, name: 'contacts'},
        {path: '/posts/:id', component: SinglePost, name: 'single-post'},
        {path: '*', component: NotFoundPage},
    ]
});

export default router;