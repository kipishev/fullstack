<template>
    <div v-if="loading" class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div v-else>
        <template v-if='errors'>
            <div class="alert alert-danger">
                <div v-for='(error, idx) in errors' :key='idx' class="errors">
                    <p v-for='(e, i) in error' :key='i'>{{ e }}</p>
                </div>
            </div>
        </template>
        <div class="mb-3">
            <label class="form-label">Изображение</label>
            <image class="user-picture mb-2" :src="user.picture"></image>
            <input type="file" name="picture" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Почта</label>
            <input v-model="user.email" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input v-model='user.name' class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Текущий пароль</label>
            <input v-model='current_password' type="password" autocomplete="off" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Новый пароль</label>
            <input v-model='password' type="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Повторите новый пароль</label>
            <input v-model='password_confirmation' type="password" class="form-control">
        </div>
        <!--TODO слетел список адресов в профиле - починить!-->
        <div class="mb-3">
            <label class="form-label">Список адресов</label>
            <div v-for='address in user.addresses' :key="address.id">
                <input :checked='address.main' :id="`main_address${ address.id }`" type="radio">
                <label :for="`main_address${ address.id }`"> {{ address.address }}</label>
            </div>
            <span v-if='!user.addresses'>
                Адресов пока нет.
            </span>
            <!--<span v-if='!user.addresses.length'>
                Адресов пока нет.
            </span>-->
            <!--TODO протестить пользователя, у которого нет адресов-->
        </div>
        <div class="mb-2">
            <label class="form-label">Новый адрес</label>
            <input v-model='new_address' class="form-control">
        </div>
<!--Реализовать самостоятельно-->
        <!--<div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="new_main_address">
            <label class="form-check-label" for="new_main_address">Сделать новый адрес основным</label>
        </div>-->
        <button @click='save' class="btn btn-primary">Сохранить</button>
    </div>
</template>

<script>
export default {
    name: "ProfilePage",
    data () {
        return {
            loading: true,
            user: null,
            new_address: null,
            password: null,
            current_password: null,
            password_confirmation: null,
            errors: null,
        }
    },
    methods: {
        save () {
            this.errors = null
            const params = {
                name: this.user.name,
                email: this.user.email,
                userId: this.user.id,
            }
            axios.post('/api/profile/save', params)
                .then(() => {
                    alert('SAVED!')
                })
                .catch((error) => {
                    //console.log(error.response.data)
                    this.errors = error.response.data.errors
                })
        }
    },
    mounted () {
        axios.get('/api/user')
            .then((response) => {
                this.user = response.data.user
                this.loading = false
                //console.log(this.user)
            })
    },
}
</script>

<style scoped>
    .user-picture {
        width: 100px;
        border-radius: 100px;
        display: block;
    }
    .errors {
        padding: 10px 10px 0px;
    }
</style>
