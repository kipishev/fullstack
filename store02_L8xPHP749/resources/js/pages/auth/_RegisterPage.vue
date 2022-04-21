<template>
    <div>
        <input v-model="name" type="text" placeholder="name" class="form-control">
        <input v-model="email" type="email" placeholder="email" class="form-control">
        <input v-model="password" type="password" placeholder="password" class="form-control">
        <input v-model="password_confirmation" type="password" placeholder="password_confirmation" class="form-control">
        <input @click.prevent="register" type="submit" value="register" class="btn btn-primary">
    </div>
</template>

<script>
export default {
    name: "RegisterPage",

    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
        }
    },

    methods: {
        register() {
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    })
                        .then(response => {
                            console.log(response)
                        })
                })
        }
    }
}
</script>

<style scoped>

</style>
