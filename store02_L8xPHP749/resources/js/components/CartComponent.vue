<template>
    <div>
        <div v-if='errors.length' class="alert alert-warning" role="alert">
            <span v-for='(error, idx) in errors' :key='idx'>{{ error }} <br></span>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for='(product, idx) in products' :key='product.id'>
                    <td>{{ idx +1 }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td class="product-buttons">
                        <button @click="cartAction('removeFrom', product.id)" class="btn btn-danger">-</button>
                        {{ product.quantity }}
                        <button @click="cartAction('addTo', product.id)" class="btn btn-success">+</button>
                    </td>
                    <td>
                        {{ Number(product.price * product.quantity).toFixed(2) }}
                    </td>
                </tr>
                <tr v-if='!products.length' >
                    <td class="text-center" colspan="5">
                        Корзина пока пуста, начните <a href="/">покупать!</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">Итого</td>
                    <td>
                        <strong>{{ Number(summ).toFixed(2) }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <input placeholder="Имя" class="form-control mb-2" name="name" v-model="user.name">
        <input placeholder="Почта" class="form-control mb-2" name="email" v-model="user.email">
        <input placeholder="Адрес" class="form-control mb-2" name="address" v-model="address">
        <template v-if="!user.name">
            <input id="register_conformation" name="register_conformation" type="checkbox">
            <!--TODO не забыть добавить оферту-->
            <label for="register_conformation">Зарегистрировать автоматически</label>
            <br>
        </template>
        <button v-if='loading' class="btn btn-success" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Оформляем заказ...
        </button>
        <button v-else @click='createOrder' type="submit" class="btn btn-success">Оформить заказ</button>
    </div>
</template>

<script>
import InputComponent from './custom/InputComponent'

export default {
    name: "CartComponent",
    props: ['prods', 'user', 'address'],
    components: {InputComponent},
    data () {
        return {
            randomText: 'RandomText',
            products: this.prods,
            errors: [],
            loading: false
        }
    },
    computed: {
        summ () {
            return this.products.reduce((sum, product) => {
                return sum += product.price * product.quantity
            }, 0)
        }
    },
    methods: {
        cartAction (type, id) {
            const params = {
                id
            }
            axios.post(`/cart/${type}Cart`, params)
                .then(response => {
                    const index = this.products.findIndex((product) => {
                        return product.id == id
                    })
                    if (response.data > 0) {
                        this.products[index].quantity = response.data
                    } else {
                        this.products.splice(index, 1)
                    }
                })
        },
        createOrder () {
            this.loading = true
            this.errors = []
            const params = {
                name: this.user.name,
                email: this.user.email,
                address: this.address,
            }
            axios.post('cart/createOrder', params)
                .then(() => {
                    document.location.href = '/'
                })
                .catch(error => {
                    const errors = error.response.data.errors
                    for (let err in errors) {
                        errors[err].forEach(e => {
                            this.errors.push(e)
                        })
                    }
                })
            .finally(() => {
                this.loading = false
            })
        },
    },
    /*TODO В идеале было бы вынести кнопочки в отдельный компонент чтобы избежать дублирования кода c ProductComponent
       или хотя бы строку с продуктом в отдельный компонент*/
}
</script>

<style scoped>

</style>
