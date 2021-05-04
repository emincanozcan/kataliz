import {
  createRouter,
  createWebHashHistory,
  createWebHistory,
} from "vue-router";
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
  history: process.env.IS_ELECTRON
    ? createWebHashHistory()
    : createWebHistory(),
  routes,
});

export default router;
