import './bootstrap';
import {createApp} from 'vue';
import App from './components/App.vue';
import Cart from './components/cart/Cart.vue';
import Checkout from './components/cart/Checkout.vue';
import Order from './components/orders/Order.vue';
import Dropdown from './components/orders/Dropdown.vue';
import UpdateManual from './components/orders/UpdateManual.vue';
import {createRouter, createWebHistory} from 'vue-router';
import {routesList} from './routes';
import Toaster from '@meforma/vue-toaster';

const router = createRouter({
    history: createWebHistory(),
    routes: routesList
})


const app = createApp(App)
//app.use(router)
app.use(Toaster)
app.mount("#app")

const app2 = createApp(Cart)
app2.mount('#app2')

const app3 = createApp(Checkout)
app3.mount('#app3')

const app4 = createApp(Order)
app4.mount('#app4')

const app5 = createApp(Dropdown)
app5.mount('#app5')

const app6 = createApp(UpdateManual)
app6.mount('#app6')