import { createStore } from 'vuex'

export const store = createStore({
    state () {
        return {
            cartProductsQuantity: 0,
            user: null
        }
    },
    mutations: {
        setCartProductsQuantity (state, data) {
            state.cartProductsQuantity = data
        },
        setUser(state, user) {
            state.user = user
        }
    },
    actions: {
        changeCartProductsQuantity (context, data) {
            context.commit('setCartProductsQuantity', data)
        },
        setUser({commit}, user) {
            commit('setUser', user)
        }
    },
})


