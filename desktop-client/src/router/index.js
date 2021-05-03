import { createRouter, createWebHistory } from "vue-router";
import AlternativeApps from "../views/AlternativeApps";
import AppPackages from "../views/AppPackages";

const routes = [
  {
    path: "/",
    name: "AlternativeApps",
    component: AlternativeApps,
  },
  {
    path: "/app-packages",
    name: "AppPackages",
    component: AppPackages,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
