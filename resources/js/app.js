require('./bootstrap');
require("datatables.net");
require("datatables.net-bs4");

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';
import App from './components/App.vue';
import swal from 'sweetalert';
import NProgress from 'nprogress';
import '../../node_modules/nprogress/nprogress.css';
import Print from 'vue-print-nb';

Vue.use(Print);
Vue.use(VueRouter, VueAxios, Axios, swal, NProgress);

// admin routes
import AdminLogin from './components/admin/Login.vue';
import AdminLogout from './components/admin/Logout.vue';
import AdminMaster from './components/admin/Master.vue';
import AdminPendonor from './components/admin/Pendonor.vue';
import AdminPendonorTambah from './components/admin/PendonorTambah.vue';
import AdminPendonorDetail from './components/admin/PendonorDetail.vue';
import AdminAdmin from './components/admin/Admin.vue';
import AdminAdminTambah from './components/admin/AdminTambah.vue';
import AdminAdminDetail from './components/admin/AdminDetail.vue';
import AdminPengguna from './components/admin/Pengguna.vue';
import AdminInformasiUmum from './components/admin/InformasiUmum.vue';
import AdminInformasiUmumTambah from './components/admin/InformasiUmumTambah.vue';
import AdminInformasiUmumDetail from './components/admin/InformasiUmumDetail.vue';
import AdminWelcome from './components/admin/Welcome.vue';
import AdminLaporan from './components/admin/Laporan.vue';

const routes = [
    {
        name: 'admin login',
        path: '/',
        component: AdminLogin
    },
    {
        name: 'admin mater',
        path: '/master',
        component: AdminMaster,
        children: [
            {
                name: 'admin welcome',
                path: '/master',
                component: AdminWelcome
            },
            {
                name: 'admin pendonor',
                path: '/master/pendonor',
                component: AdminPendonor
            },
            {
                name: 'admin pendonor tambah',
                path: '/master/pendonor/tambah',
                component: AdminPendonorTambah
            },
            {
                name: 'admin pendonor detail',
                path: '/master/pendonor/detail/:id',
                component: AdminPendonorDetail
            },
            {
                name: 'admin admin',
                path: '/master/admin',
                component: AdminAdmin
            },
            {
                name: 'admin admin tambah',
                path: '/master/admin/tambah',
                component: AdminAdminTambah
            },
            {
                name: 'admin admin detail',
                path: '/master/admin/detail/:id',
                component: AdminAdminDetail
            },
            {
                name: 'admin pengguna',
                path: '/master/pengguna',
                component: AdminPengguna
            },
            {
                name: 'admin informasi umum',
                path: '/master/informasi_umum',
                component: AdminInformasiUmum
            },
            {
                name: 'admin informasi umum tambah',
                path: '/master/informasi_umum/tambah',
                component: AdminInformasiUmumTambah
            },
            {
                name: 'admin informasi umum detail',
                path: '/master/informasi_umum/detail/:id',
                component: AdminInformasiUmumDetail
            },
            {
                name: 'admin laporan',
                path: '/master/laporan',
                component: AdminLaporan
            },
        ]
    },
    {
        name: 'admin logout',
        path: '/logout',
        component: AdminLogout
    }
]

Vue.prototype.pendonorApi = 'https://erthru.pro/pendonor/public/api/';
Vue.prototype.asset = 'https://erthru.pro/pendonor/public/';

const router = new VueRouter({ base:'/pendonor/public', mode: 'history', routes: routes });

router.beforeResolve((to, from, next) => {
    if (to.name) {
        NProgress.start()
    }
    next()
})

router.afterEach((to, from) => {
    NProgress.done()
})

new Vue(
    Vue.util.extend({ router }, App)
).$mount("#app");
