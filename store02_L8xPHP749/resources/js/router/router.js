import { createRouter, createWebHistory } from 'vue-router'

import CategoriesPage from '../pages/CategoriesPage'
import CategoryProductsPage from '../pages/CategoryProductsPage'
import CartPage from '../pages/CartPage'
import ProfilePage from '../pages/ProfilePage'
import LoginPage from '../pages/auth/LoginPage'
import RegisterPage from '../pages/auth/RegisterPage'

const Component404 = { template: '<div>Страница не найдена</div>' }

const routes = [
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: Component404 },
    { path: '/', component: CategoriesPage },
    { path: '/category/:id', component: CategoryProductsPage },
    { path: '/cart', component: CartPage },
    { path: '/profile', component: ProfilePage },
    { path: '/auth/login', component: LoginPage},
    { path: '/auth/register', component: RegisterPage},
]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})
