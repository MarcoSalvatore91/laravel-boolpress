import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/pages/Home.vue'
import Contacts from './components/pages/Contacts.vue'
import NotFoundPage from './components/pages/NotFoundPage.vue'

const router = new VueRouter({
    
    mode: 'history',

    routes: [
        {path: '/', component: Home, name: 'home'},
        {path: '/contacts', component: Contacts, name: 'contacts'},
        {path: '*', component: NotFoundPage},
    ]
});

export default router;