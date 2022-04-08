<template>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <router-link class="nav-link" to="/cart">
                Корзина <span id='cartProductsQuantity'>({{ cartProductsQuantity }})</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" to="/auth/login">
                Авторизация
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" to="/auth/register">
                Регистрация
            </router-link>
        </li>
        <li class="nav-item">
            <button @click='logout' class="btn nav-link btn-link">
                Выход
            </button>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" to="/profile">
                Профиль
            </router-link>
        </li>
    </ul>
</template>

<script>

export default {
    name: "NavBarCartComponent",
    computed: {
        cartProductsQuantity () {
            return this.$store.state.cartProductsQuantity
        },
    },
    methods: {
        logout () {
            axios.get('/api/auth/logout')
                .then(() => {
                    this.$store.dispatch('setUser', null)
                    this.$router.push('/auth/login')
                })
        }
    },
    mounted () {
        let cart = JSON.parse(localStorage.getItem('cart'))

        let quantity = 0
        for (let key in cart) {
            quantity += cart[key]
        }
        this.$store.dispatch('changeCartProductsQuantity', quantity)

        //Code for Vue.js
        /*axios.get('/cart/productsQuantity')
            .then((response) => {
                this.$store.dispatch('changeCartProductsQuantity', response.data)
            })*/

        axios.get('/api/user')
            .then((response) => {
                this.$store.dispatch('setUser', response.data)
            })
    }
}
</script>

<style scoped>

</style>
