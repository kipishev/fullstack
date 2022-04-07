<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Регистрация</div>

            <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>
                        <div class="col-md-6">
                            <input v-model='name' id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Почта</label>
                        <div class="col-md-6">
                            <input v-model='email' id="email" type="email" class="form-control" name="email" required autocomplete="email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>
                        <div class="col-md-6">
                            <input v-model='password' id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Повторите пароль</label>
                        <div class="col-md-6">
                            <input v-model='password_confirmation' id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button @click='register' type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "RegisterPage.vue",
    data () {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        }
    },
    methods: {
        register () {
            const params = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            }
            axios.get('/api/auth/register', {params})
                .then(response => {
                    const user = response.data.user
                    if (user) {
                        this.$store.dispatch('setUser', user)
                        this.$router.push('/')
                    }
                })
                .catch((error) => {
                    const errors = error.response.data.errors
                    console.log(errors)
                })
        }
    }
}
</script>

<style scoped>

</style>
