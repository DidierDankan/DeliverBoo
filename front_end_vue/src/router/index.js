import { createRouter, createWebHashHistory } from "vue-router";
import Home from "../views/Home.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/About.vue"),
  },
  {
    path: "/restaurants",
    name: "Restaurants",
    component: () => import("../views/Restaurants.vue"),
  },
  {
    path: "/restaurants/:id",
    name: "restaurant-detail",
    component: () => import("../views/RestaurantDetail.vue"),
  },

  {
    path: "/tipi",
    name: "Tipi",
    component: () => import("../views/Tipi.vue"),
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
