<template>
    <div>
        <div class="row">
            <category-component
                v-for='category in categories'
                :key="category.id"
                :category='category'
                @buttonClicked='buttonClicked'
            >
            </category-component>
        </div>
    </div>
</template>

<script>
import CategoryComponent from '../components/CategoryComponent'
export default {
    name: "CategoriesPage",
    components: {CategoryComponent},
    data () {
        return {
            categories: []
        }
    },
    methods: {
        buttonClicked (data) {
            console.log(`Клик в дочернем элементе (${data})`)
        },
    },
    mounted () {
        axios.get('/api/getCategories')
            .then((response) => {
                this.categories = response.data
            })
    },
}
</script>

<style scoped>

</style>
