import Vue from "vue";
import Vuex from 'vuex'
import GameHistory from "../components/GameHistory";
import GameTable from "../components/GameTable";
import ChessBoard from "chessboardjs";
import * as Chess from '../../chess';

Vue.use(Vuex)

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

