<template>
    <div class="col-3">
        <div class="card mb-4" style="width: 18rem;">
            <img style="width: 200px" :src="`/storage/${category.picture}`" class="card-img-top" :alt="category.name">
            <div class="card-body">
                <h5 class="card-title">{{ category.name }}</h5>
                <p class="card-text">{{ category.description }}</p>
                <router-link :to='`/category/${category.id}`'>Перейти</router-link>
                <button @click='buttonClicked' class="btn btn-link">CLICK</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CategoryComponent",
    props: ['category', 'routeCategory'],
    methods: {
        buttonClicked () {
            this.$emit('buttonClicked', this.category.id)
        },
    },
}
</script>
