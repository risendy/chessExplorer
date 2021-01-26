import '../styles/app.css';
const $ = require('jquery');

import ChessBoard from 'chessboardjs';
import * as Chess from '../chess';
import Vue from 'vue';
import App from './components/App.vue'

import GameHistory from './components/GameHistory.vue'
import GameTable from './components/GameTable.vue'
import store from './store/store.js'

const chessObj = new Chess();
var originalPng;
var modifiedPng;

new Vue({
    el: '#app',
    store,
    render: h => h(App),
})
