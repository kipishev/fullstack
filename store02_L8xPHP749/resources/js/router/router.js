import { createRouter, createWebHistory } from 'vue-router'

import CategoriesPage from '../pages/CategoriesPage'
import CategoryProductsPage from '../pages/CategoryProductsPage'

const Component404 = { template: '<div>Страница не найдена</div>' }

const routes = [
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: Component404 },
    { path: '/', component: CategoriesPage },
    { path: '/category/:id', component: CategoryProductsPage },
]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})
