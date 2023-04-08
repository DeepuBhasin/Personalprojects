import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/country/:name",
    name: "country-details",
    component: () => import("../views/CountryDetailsView.vue"),
  },
  {
    path: "/:catchAll(.*)",
    name: "ErrorPage",
    component: HomeView,
  },
  {
    path: "/country/Republic%20of%20Kosovo",
    name: "Serbia",
    component: HomeView,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
