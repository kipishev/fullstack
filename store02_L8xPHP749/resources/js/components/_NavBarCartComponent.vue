<template>
    <div>
        <router-link to="/get">Get</router-link>
        <router-link to="/auth/login"> Login</router-link>
        <router-link to="/auth/register"> Registration</router-link>
        <a @click.prevent="logout" href="#"> Logout</a>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "NavBarCartComponent",

    methods: {
        logout() {
            axios.post('/logout')
              .then(response => {
                  this.$router.push('/auth/login')
              })
        }
    }
}
</script>

<style scoped>

</style>
