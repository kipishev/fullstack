<template>
    <div>
        <input v-model="email" type="email" placeholder="email" class="form-control">
        <input v-model="password" type="password" placeholder="password" class="form-control">
        <input @click.prevent="login" type="submit" value="login" class="btn btn-primary">
    </div>
</template>

<script>
export default {
    name: "LoginPage",

    data() {
        return {
            email: null,
            password: null,
        }
    },

    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {email: this.email, password: this.password}).then(response => {
                    console.log(response.config.data)
                })
                .catch(error => {
                    console.log(error.response)
                })
            })
            axios.get('/api/auth/getAuthUser').then(response => {
                console.log(response)
            })
        }
    }
}
</script>

<style scoped>

</style>
