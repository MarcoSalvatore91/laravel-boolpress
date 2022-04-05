import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './components/pages/Home.vue'
import Contacts from './components/pages/Contacts.vue'
import NotFoundPage from './components/pages/NotFoundPage.vue'

const router = new VueRouter({
    
    mode: 'history',

    routes: [
        {path: '/', components: Home, name: 'home'},
        {path: '/contacts', components: Contacts, name: 'contacts'},
        {path: '*', components: NotFoundPage},
    ]
});

export default router;