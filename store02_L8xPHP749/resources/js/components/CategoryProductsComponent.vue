<template>
    <div class="row" :class="{'m-top': !products.length}">
        <div v-if="!products.length" class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <product-component
            v-else
            v-for='product in products'
            :key='product.id'
            :product="product"
        >
        </product-component>
    </div>
</template>

<script>
import ProductComponent from './ProductComponent'

export default {
    name: "CategoryProductsComponent",
    props: ['category'],
    components: {ProductComponent},
    data () {
        return {
            products: []
        }
    },
    mounted() {
        axios.get(`/category/${this.category}/getProducts`)
        .then(response => {
            this.products = response.data
        })
    }
}
</script>

<style scoped>
    .row {
        justify-content: space-around;
    }
    .m-top {
        margin-top: 40%;
    }
</style>
