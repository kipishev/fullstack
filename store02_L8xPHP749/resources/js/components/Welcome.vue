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

    <select v-model="selected" class="form-control mb-5">
        <option :value="null" selected disabled>-- Выберете значение --</option>
        <option v-for="(option, idx) in options" :value="option" :key="idx">
            {{ option }}
        </option>
    </select>
    <button :disabled="!selected" class="btn mt-5" :class="buttonClass">Сохранить</button>
    <br>
    <button @click='getData' class="btn btn-info">Получить данные</button>

    <table class="table table-bordered">
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
            </tr>
            <tr v-if="!users.length">
                <td class="text-center" colspan="3">
                    <em>
                        Данные пока не получены
                    </em>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "Welcome",
    data () {
        return {
            users: [],
            text: '',
            inputText: '',
            title: 'Welcome Vue JS 3',
            name: 'Andrei',
            lastName: 'Tikishev',
            counter: 0,
            selected: null,
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
        buttonClass () {
            return this.selected ? 'btn-success' : 'btn-primary'
        },
        fullName () {
            return this.name + ' ' + this.lastName
        },
        reversedText () {
            return this.text.split('').reverse().join('')
        },
    },
    watch: {
        selected: function (newValue, oldValue) {
            console.log(`Новое значение: ${newValue}, старое значение: ${oldValue}`)
        },
    },
    methods: {
         getData () {
             const params = {
                 id: 1
             }
             axios.get('api/test', {params})
                .then(response => {
                    this.users = response.data
                })
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
