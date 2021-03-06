import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/components/pages/HomePage'
import UsersBetsPage from '@/components/pages/UsersBetsPage'
import CreateBetPage from '@/components/pages/CreateBetPage'
import BankPage from '@/components/pages/BankPage'
import AboutPage from '@/components/pages/AboutPage'
import LoginPage from '@/components/pages/LoginPage'
import EditBetPage from '@/components/pages/EditBetPage'
import NotFoundPage from '@/components/pages/NotFoundPage'

Vue.use(Router)

export default new Router({
  routes: [{
    path: '/',
    name: 'Default',
    component: HomePage
  },
  {
    path: '*',
    name: 'NotFound',
    component: NotFoundPage
  },
  {
    path: '/home',
    name: 'HomePage',
    component: HomePage
  },
  {
    path: '/my-bets',
    name: 'UsersBetsPage',
    component: UsersBetsPage
  },
  {
    path: '/create-bet',
    name: 'CreateBetPage',
    component: CreateBetPage
  },
  {
    path: '/bank',
    name: 'BankPage',
    component: BankPage
  },
  {
    path: '/about',
    name: 'AboutPage',
    component: AboutPage
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage
  },
  {
    path: '/edit-bet/:id',
    name: 'EditBet',
    component: EditBetPage,
    props: true
  }
  ]
})
