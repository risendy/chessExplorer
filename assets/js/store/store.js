import Vue from "vue";
import Vuex from 'vuex'
import GameHistory from "../components/GameHistory";
import GameTable from "../components/GameTable";
import ChessBoard from "chessboardjs";
import * as Chess from '../../chess';
import * as Func from "../modules/functions";
import * as Ajax from "../modules/ajaxCalls";

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
        game: null,
        possibleMoves: [],
        fen: '',
        test: 1,
        movePositionButtonsVisible: false
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
        },
        getBoard (state) {
            return state.board;
        },
        getPossibleMoves (state) {
            return state.possibleMoves;
        },
        getMovePositionButtonsVisible (state) {
            return state.movePositionButtonsVisible;
        }
    },
    mutations: {
        changePgn (state , pgn) {
            state.pgnState = pgn
        },
        changeMostPopularMoves (state , moves) {
            state.possibleMoves = moves
        },
        calculateFen(state, pgn) {
            state.game.load_pgn(pgn);
            state.fen = state.game.fen();
        },
        setInitBoard (state, cfg) {
                state.board = new ChessBoard('board', cfg);
        },
        setMoveButtons(state, flag) {
            state.movePositionButtonsVisible = flag;
        },
        setInitGame (state) {
            state.game = new Chess();
                state.game.load('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1');

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
        saveFen(state, fen) {
            state.fen = fen;
        },
    },
    actions: {
        prevMove(state) {
            state.commit('prevMove');
        },
        nextMove(state) {
            state.commit('nextMove');
        },
        resetPosition(state) {
            var config = {
                draggable: true,
                position: 'start',
                onDragStart: Func.onDragStart,
                onDrop: Func.onDrop,
                onSnapEnd: Func.onSnapEnd
            }

            state.commit('setInitBoard', config);
            state.commit('setInitGame');

            state.commit('changePgn', '');
            Ajax.getMostPopularMovesInThePosition();
        },
        clearPopularMoves(state) {
            state.commit('changeMostPopularMoves', []);
        },
        setMoveButtons(state, flag) {
            state.commit('setMoveButtons', flag);
        }
    }
})

