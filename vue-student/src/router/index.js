import Vue from "vue";
import VueRouter from "vue-router";
import store from "../store/index";
import Login from "@/components/Login";
import Register from "@/components/Register";
import TargetCreateHome from "@/components/CreateTarget/Home";
import PageNotFound from "@/components/PageNotFound";

Vue.use(VueRouter);

const tokenCheck = function () {
  return store.getters.checkToken;
};

const auth = function (to, from, next) {
  return tokenCheck() === true ? next() : next('/giris');
}

const guest = function (to, from, next) {
  return tokenCheck() === false ? next() : next('anasayfa');
}

const routes = [
  {
    path: "/",
    redirect: "/giris"
  },
  {
    path: "/giris",
    name: "Login",
    component: () => import('@/components/Login'),
    beforeEnter: guest
  },
  {
    path: "/kayit",
    name: "Register",
    component: () => import('@/components/Register'),
    beforeEnter: guest
  },
  {
    path: "/anasayfa",
    name: "HomePage",
    component: () => import('@/components/Student/Homepage'),
    beforeEnter: auth,
    children: [
      {
        path: "/",
        name: "HomeMenu",
        component: () => import('@/components/Student/HomeMenu')
      },
      {
        path: "hedef-olustur",
        name: "TargetCreateHome",
        component: () => import('@/components/CreateTarget/Home')
      },
      {
        path: 'hedeflerim',
        name: "MyTargetHome",
        component: () => import('@/components/MyTargets/Home')
      },
      {
        path: 'gecmis-hedeflerim',
        name: "MyLastTargetHome",
        component: () => import('@/components/MyLastTargets/Home')
      },
      {
        path: 'ayarlar',
        name: 'Settings',
        component: () => import('@/components/Settings/Home'),
        children: [
          {
            path: 'profil',
            component: () => import('@/components/Settings/Profile'),
            name: 'SettingsProfile',
          },
          {
            path: 'sifre-degistir',
            component: () => import('@/components/Settings/Password'),
            name: 'SettingsPassword',
          },
          {
            path: 'diger',
            component: () => import('@/components/Settings/Other'),
            name: 'SettingsOther',
          },
        ]
      },
      {
        path: 'kullanici-hedef-orani',
        name: 'UserTargetRate',
        component: () => import('@/components/UserTargetsRate/Home'),
      },
      {
        path: 'kullanici-hedef-orani/:userId',
        name: 'GetProfileRates',
        component: () => import('@/components/UserTargetsRate/UserProfile/ProfileRates'),
      }
    ]
  },
  {
    path: "*",
    component: PageNotFound
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

// Refresh Page
router.beforeEach((to, from, next) => {
  store.commit("setState");
  next();
});

export default router;
