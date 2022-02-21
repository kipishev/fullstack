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
                <td>
                    <a :href="`/category/${category.id}`">
                        {{ category.name }} {{ category.id }}
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <button @click="addCategory" class="btn btn-primary">Добавить категорию</button>
    <br>
    {{ fullName }}
    <br>
    {{ fullName }}
    <br>
    <input v-model="inputText" @input="listenInput" class="form-control">
    <input v-model="name" class="class-control">
    <br>
    <input v-model="text" class="class-control">
    <br>
    {{ reversedText }}

    <select class="form-control">
        <option @change="selectChanged" v-for="(option, idx) in options" :value="option" :key="idx">
            {{ option }}
        </option>
    </select>
</template>

<script>
export default {
    name: "Welcome",
    data () {
        return {
            text: '',
            inputText: '',
            title: 'Welcome Vue JS 3',
            name: 'Andrei',
            lastName: 'Tikishev',
            counter: 0,
            showPicture: true,
            options: [1, 2, 3,],
            categories: [
                {
                    id: 5,
                    name: 'Видеокарты',
                },
                {
                    id: 6,
                    name: 'Процессоры',
                },
                {
                    id: 10,
                    name: 'Жесткие диски'
                },
            ],
        }
    },
    computed: {
        fullName () {
            return this.name + ' ' + this.lastName
        },
        reversedText () {
            return this.text.split('').reverse().join('')
        },
    },
    methods: {
        selectChanged () {
            console.log('')
        },
        listenInput () {
            console.log(this.inputText)
        },
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
