import './bootstrap';
import { createApp, render } from 'vue';
import App from './App.vue';
import router from './router/index.js';
import store from './store/index.js';
import '../css/datatables.min.css';

window.base_path = window.location.origin;

const app = createApp(App);
store.dispatch('initializeAuth');
app.use(router)
app.use(store)
app.mount('#app')
