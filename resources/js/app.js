import './bootstrap';
import "bootstrap/dist/css/bootstrap.min.css"

import { createApp } from 'vue';
import App from './App.vue';
import VueAxios from 'axios';
import router from './router';

let app = createApp(App)
app.use(VueAxios, axios);
app.use(router, router);
app.mount('#app');
