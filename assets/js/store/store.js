import Vue from "vue";
import Vuex from 'vuex'
import GameHistory from "../components/GameHistory";
import GameTable from "../components/GameTable";
import ChessBoard from "chessboardjs";
import * as Chess from '../../chess';
import axios from "axios";

Vue.use(Vuex)

export async function fetchUsers (opts) {
    const games = await window.fetch(`/get_paginated_games?page=${opts.page}&limit=${opts.pageSize}`)
        .then(response => {
            return response.json();
        })
        .catch((error) => {
            this.dispatch('SHOW_GLOBAL_ERROR_MESSAGE', error.response.data.message);
            return {
                total: 0,
                data: [],
            };
        });

    return {
        total: games[0].total,
        data: games[0].items
    }
}

export default new Vuex.Store({
    state: {
        pgnState: '',
        board: null,
        game: {},
        fen: ''
    },
    getters: {
        getPgn (state) {
            return state.pgnState;
        },
        getFen (state, pgn) {
            return state.fen;
        },
        getGame (state) {
            return state.game;
        }
    },
    mutations: {
        changePgn (state , pgn) {
            state.pgnState = pgn
        },
        calculateFen(state, pgn) {
            state.game.load_pgn(pgn);
            state.fen = state.game.fen();
        },
        setInitBoard (state) {
            if (!state.board) {
                state.board = new ChessBoard('board', 'start');
            }
        },
        setInitGame (state) {
            state.game = new Chess();
        },
        changeBoardPosition(state, fen) {
            state.board.position(fen);
        },
        prevMove(state) {
            let fen = state.game.back();
            state.board.position(fen);
        },
        nextMove(state) {
            let fen = state.game.next();
            state.board.position(fen);
        },
    },
    actions: {
        prevMove(state) {
            state.commit('prevMove');
        },
        nextMove(state) {
            state.commit('nextMove');
        },
    }
})

