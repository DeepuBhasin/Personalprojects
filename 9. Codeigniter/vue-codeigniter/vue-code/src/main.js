import { createApp } from "vue"
import App from "@/App.vue"
import router from "@/routers/index";
import AlertMessage from "@/components/alert/AlertMessage.vue";
const app = createApp(App);
app.component('alert-message',AlertMessage);
app.use(router)
app.mount("#app");
