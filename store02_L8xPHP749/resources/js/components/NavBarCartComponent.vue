<template>
    <li class="nav-item">
        <router-link class="nav-link" to="/cart">
            Корзина <span id='cartProductsQuantity'>({{ cartProductsQuantity }})</span>
        </router-link>
    </li>
</template>

<script>

export default {
    name: "NavBarCartComponent",
    computed: {
        cartProductsQuantity () {
            return this.$store.state.cartProductsQuantity
        },
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
    }
}
</script>

<style scoped>

</style>
