import { createStore } from 'vuex'

export const store = createStore({
    state () {
        return {
            cartProductsQuantity: 0
        }
    },
    mutations: {
        setCartProductsQuantity (state, data) {
            state.cartProductsQuantity = data
        }
    },
    actions: {
        changeCartProductsQuantity (context, data) {
            context.commit('setCartProductsQuantity', data)
        }
    },
})


