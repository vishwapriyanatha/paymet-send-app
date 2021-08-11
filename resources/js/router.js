import Vue from 'vue';
import Router from 'vue-router';
import MainLayout from './components/MainComponent';
import Payment from './components/Payment';

Vue.use(Router);
const router = new Router({
    routes: [
        {
            name: 'home',
            path: '/',
            component: MainLayout,
            redirect: {name: 'payment'},
            children: [
                {
                    name: 'payment',
                    path: '/payment',
                    component: Payment,

                }
            ]
        }]
});

export default router;
