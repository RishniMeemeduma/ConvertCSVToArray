import {createRouter, createWebHistory} from 'vue-router';

import CsvFileConverter from './CsvFileConverter.vue';

const routes = [
    {
        path:'/',
        name:'home',
        component: CsvFileConverter
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})
export default router;