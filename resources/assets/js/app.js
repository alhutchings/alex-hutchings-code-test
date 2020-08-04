import router from './routes'
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

new Vue({
    vuetify: new Vuetify(),
    router
}).$mount('#app')