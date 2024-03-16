import './bootstrap';
import "bootstrap/dist/css/bootstrap.min.css"

import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import router from './router';

let app = createApp(App)
app.use(VueAxios, axios);
app.use(router, router);
app.mount('#app');
