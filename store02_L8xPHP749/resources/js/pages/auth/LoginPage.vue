<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Авторизация</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Почта</label>
                        <div class="col-md-6">
                            <input v-model='email' id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>
                        <div class="col-md-6">
                            <input v-model='password' id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Запомнить меня</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button @click='login' type="submit" class="btn btn-primary">Войти</button>
                            <a class="btn btn-link" href="#">Забыли пароль?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LoginPage.vue",
    data () {
        return {
            email: '',
            password: '',
        }
    },
    methods: {
        login () {
            axios.get('/sanctum/csrf-cookie').then(response => {
                const params = {
                    email: this.email,
                    password: this.password,
                }
                axios.get('/api/auth/login', {params})
                    .then(response => {
                        const user = response.data.user
                        if (user) {
                            this.$store.dispatch('setUser', user)
                            this.$router.push('/')
                        } else {
                            alert('wrong data')
                        }
                    })
            });
        }
    },
}
</script>

<style scoped>

</style>
