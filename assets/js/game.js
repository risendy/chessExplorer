import '../styles/app.css';
const $ = require('jquery');

import ChessBoard from 'chessboardjs';
import * as Chess from '../chess';
import Vue from 'vue';
import Vuex from 'vuex'
import App from './components/App.vue'

import store, {fetchFavouriteGames} from './store/index.js'
import { fetchGames } from './store/index.js'
import { PaginationPlugin, createResource } from 'vuex-pagination'
import { BootstrapVue } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)

Vue.use(Vuex)
Vue.use(PaginationPlugin)

export const games = createResource('games', fetchGames);
export const favouriteGames = createResource('favouriteGames', fetchFavouriteGames);

new Vue({
    el: '#app',
    store,
    render: h => h(App),
})
