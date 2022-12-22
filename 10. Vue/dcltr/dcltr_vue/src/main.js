import { createApp } from 'vue'
import AppWrapper from './AppWrapper.vue'
import router from './Router';
import store from './store'
import axios from 'axios';
import useVuelidate from '@vuelidate/core';
import SectionHeader from '@/components/SectionHeader/SectionHeader.vue'
import Card from '@/components/Card/Card.vue';
import 'vue-select/dist/vue-select.css';
import vSelect from  'vue-select';

const app = createApp(AppWrapper);

app.component('SectionHeader',SectionHeader);
app.component('v-select',vSelect);
app.use(store)
    .use(useVuelidate)
    .use(router)
    .mount('#app')

axios.defaults.withCredentials = true;
axios.defaults.baseUrl = "http://dcltr.oidea.xyz/"
