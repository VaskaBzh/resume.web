import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/complexity",
    name: "complexity",
    component: () => import("../views/ComplexityView"),
  },
  {
    path: "/faqview",
    name: "faqview",
    component: () => import("../views/FaqView"),
  },
  {
    path: "/about",
    name: "about",
    component: () => import("../views/AboutView.vue"),
  },
  {
    path: "/ref",
    name: "ref",
    component: () => import("../views/account/RefView.vue"),
  },
  {
    path: "/wallets",
    name: "wallets",
    component: () => import("../views/account/WalletsView.vue"),
  },
  {
    path: "/history",
    name: "history",
    component: () => import("../views/account/HistoryWalletsView.vue"),
  },
  {
    path: "/loginReg",
    name: "loginReg",
    component: () => import("../views/LoginRegistration.vue"),
  },
  {
    path: "/profile",
    name: "profile",
    component: () => import("../views/account/ProfileView.vue"),
    redirect: "/accounts",
    children: [
      {
        path: "/accounts",
        name: "accounts",
        component: () => import("../views/account/AccountsView.vue"),
      },
      {
        path: "/statistic",
        name: "statistic",
        component: () => import("../views/account/StatisticView.vue"),
      },
      {
        path: "/workers",
        name: "workers",
        component: () => import("../views/account/WorkersView.vue"),
      },
      {
        path: "/connecting",
        name: "connecting",
        component: () => import("../views/account/ConnectingView.vue"),
      },
      {
        path: "/payment",
        name: "payment",
        component: () => import("../views/account/PaymentView.vue"),
      },
      {
        path: "/accruals",
        name: "accruals",
        component: () => import("../views/account/AccrualsView.vue"),
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
