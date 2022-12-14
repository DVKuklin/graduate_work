import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Contacts from '../views/Contacts.vue'
import Authorization from '../views/Authorization.vue'
import SectionMenu from '../views/SectionMenu.vue'
import Theme from '../views/Theme.vue'
import NotFound from '../views/NotFound.vue'
import { getSections, getThemesAndSectionBySectionUrl } from '../services/methods.js';


let sections = await getSections();
let sectionRoutes = sections.data.map(function(item,index){
  return {
    path: '/'+item.url+'/',
    component: SectionMenu
  }
})


let routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about/',
    name: 'About',
    component: About
  },
  {
    path: '/contacts/',
    name: 'Contacts',
    component: Contacts
  },
  {
    path: '/avt/',
    name: 'Authorization',
    component: Authorization
  }
]

//Добавляем руты для меню разделов 
for (let i = 0;i<sectionRoutes.length;i++) {
    routes.push(sectionRoutes[i]);
}

//Роуты для тем
for (let i = 0;i<sections.data.length;i++) {
  let tempThems = await getThemesAndSectionBySectionUrl(sections.data[i].url);

  for (let j=0; j<tempThems.data.themes.length;j++) {
    routes.push({
      path: '/'+sections.data[i].url+'/'+tempThems.data.themes[j].url+'/',
      component: Theme
    })
  }
}

//Редирект на несуществующие страницы
routes.push(
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: NotFound
  },
)


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: routes
})


//Редирект на несуществующие страницы дополнение
router.resolve({
  name: 'not-found',
  params: { pathMatch: ['not', 'found'] },
}).href

export default router