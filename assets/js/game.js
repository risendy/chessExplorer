import '../styles/app.css';
const $ = require('jquery');

import ChessBoard from 'chessboardjs';
import * as Chess from '../chess';
import Vue from 'vue';
import Vuex from 'vuex'
import App from './components/App.vue'

import store from './store/store.js'
import { fetchGames } from './store/store.js'
import { PaginationPlugin, createResource } from 'vuex-pagination'

Vue.use(Vuex)
Vue.use(PaginationPlugin)

createResource('games', fetchGames);

new Vue({
    el: '#app',
    store,
    render: h => h(App),
})
