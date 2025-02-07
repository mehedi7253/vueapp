import './bootstrap';
import { createApp, render } from 'vue';
import App from './App.vue';
import router from './router/index.js';
window.base_path = window.location.origin;

const app = createApp(App);
app.use(router)
app.mount('#app')
