import Vue from "vue";
import Vuex from 'vuex'
import GameHistory from "../components/GameHistory";
import GameTable from "../components/GameTable";
import ChessBoard from "chessboardjs";
import * as Chess from '../../chess';
import * as Func from "../modules/functions";
import * as Ajax from "../modules/ajaxCalls";

Vue.use(Vuex)

export async function fetchGames (opts) {
    const games = await window.fetch(`/get_paginated_games?page=${opts.page}&limit=${opts.pageSize}&whitePlayerFilter=${opts.args.whitePlayerFilter}&blackPlayerFilter=${opts.args.blackPlayerFilter}&resultFilter=${opts.args.resultFilter}`)
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
        movePositionButtonsVisible: false,
        activeMove: null,
        activeGameRow: null,
        gameHistory: null
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
        },
        activeMove (state) {
            return state.activeMove;
        },
        activeGameRow (state) {
            return state.activeGameRow;
        },
        gameHistory (state) {
            return state.gameHistory;
        }
    },
    mutations: {
        setGame (state , game) {
            state.game = game
        },
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
           let gameHistory = state.gameHistory;
           let activeMove = state.activeMove;
           this.dispatch('calculateNewPosition', {gameHistory, activeMove});
       },
       nextMove(state) {
           let gameHistory = state.gameHistory;
           let activeMove = state.activeMove;
           this.dispatch('calculateNewPosition', {gameHistory, activeMove});
       },
       saveFen(state, fen) {
           state.fen = fen;
       },
       incrementActiveMove(state) {
           state.activeMove = state.activeMove + 1;
       },
       decrementActiveMove(state) {
           state.activeMove = state.activeMove - 1;
       },
       setActiveMove(state, move) {
           state.activeMove = move;
       },
       setActiveGameRow(state, row) {
           state.activeGameRow = row;
       },
       setGameHistory(state, gameHistory) {
           state.gameHistory = gameHistory;
       },
   },
   actions: {
       calculateNewPosition(state, {gameHistory, activeMove}) {
           let game = new Chess();

           let i=0;
           while (i < (activeMove + 1)) {
               game.move(gameHistory[i]);

               if (i == activeMove) {
                   let fen = game.fen();

                   this.commit('setGame', game);
                   this.commit('saveFen', fen);
                   this.commit('changeBoardPosition', fen);
                   Ajax.getMostPopularMovesInThePosition(fen);
               }
               i++;
           }
       },
       setGame(state, game) {
           state.commit('setGame', game);
       },
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
        },
        incrementActiveMove(state) {
            state.commit('incrementActiveMove');
        },
        decrementActiveMove(state) {
            state.commit('decrementActiveMove');
        },
        setActiveMove(state, move) {
            state.commit('setActiveMove', move);
        },
        setActiveGameRow(state, row) {
            state.commit('setActiveGameRow', row);
        },
        setGameHistory(state, gameHistory) {
            state.commit('setGameHistory', gameHistory);
        },
    }
})

