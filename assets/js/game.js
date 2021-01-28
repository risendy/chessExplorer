import '../styles/app.css';
const $ = require('jquery');

import ChessBoard from 'chessboardjs';
import * as Chess from '../chess';
import Vue from 'vue';
import Vuex from 'vuex'
import App from './components/App.vue'

import GameHistory from './components/GameHistory.vue'
import GameTable from './components/GameTable.vue'
import store from './store/store.js'
import { createInstance } from 'vuex-pagination'
import { fetchUsers } from './store/store.js'
import { PaginationPlugin, createResource } from 'vuex-pagination'

Vue.use(Vuex)
Vue.use(PaginationPlugin)

const chessObj = new Chess();

createResource('games', fetchUsers);

new Vue({
    el: '#app',
    store,
    render: h => h(App),
})
