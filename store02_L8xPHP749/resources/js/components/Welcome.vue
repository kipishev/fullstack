<template>
    <h1>{{ title }}</h1>
    <h1>{{ name }}</h1>
    <br>
    <button v-on:click="counterPlus" class="btn btn-info">Click {{ counter }}</button>
    <span v-if="counter < 10">Значение меньше 10</span>
    <span v-else-if="counter < 15">Значение меньше 15</span>
    <span v-else>Значение больше или равно 15</span>
    <!--<span v-show="counter < 10">Значение меньше 10</span>-->
    <br>
    <button @click="showPicture = !showPicture" class="btn btn-success">Переключатель</button>
    <br>
    <img v-if="showPicture" style="width: 300px" src="https://avatanplus.com/files/resources/original/578d905c4f11215600fbe8a4.jpg">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Категория</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(category, index) in categories" :key="category.id">
                <td>{{ index + 1 }}</td>
                <td>{{ category.name }} {{ category.id }}</td>
            </tr>
        </tbody>
    </table>
    <button @click="addCategory" class="btn btn-primary">Добавить категорию</button>
</template>

<script>
export default {
    name: "Welcome",
    data () {
        return {
            title: 'Welcome Vue JS 3',
            name: 'Andrei',
            counter: 0,
            showPicture: true,
            categories: [
                {
                    id: 1,
                    name: 'Видеокарты',
                },
                {
                    id: 2,
                    name: 'Процессоры',
                },
                {
                    id: 3,
                    name: 'Материнские платы'
                },
            ],
        }
    },
    methods: {
        addCategory () {
            this.categories.push({
                id: 4,
                name: 'Оперативная память'
            })
        },
        counterPlus () {
            this.counter += 1
        },
    },
    mounted() {
    console.log('Welcome component mounted.')
    }
}
</script>

<style scoped>
</style>
