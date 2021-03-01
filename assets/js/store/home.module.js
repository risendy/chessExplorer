import ChessBoard from "chessboardjs";
import * as Chess from "../../chess";
import * as Func from "../modules/functions";
import axios from "axios";
import {createInstance, resource} from "vuex-pagination";

const state = {
    pgnState: '',
    board: null,
    game: null,
    possibleMoves: [],
    fen: '',
    movePositionButtonsVisible: false,
    activeMove: null,
    activeGameRow: null,
    gameHistory: null,
    areGamesLoading: false,
    whitePlayerFilter: '',
    blackPlayerFilter: '',
    resultFilter: '',
}

const getters = {
    getPgn: state => state.pgnState,
    getFen: state => state.fen,
    getGame: state => state.game,
    getBoard: state => state.board,
    getPossibleMoves: state => state.possibleMoves,
    getMovePositionButtonsVisible: state => state.movePositionButtonsVisible,
    activeMove: state => state.activeMove,
    activeGameRow: state => state.activeGameRow,
    gameHistory: state => state.gameHistory,
    areGamesLoading: state => state.areGamesLoading,
    whitePlayerFilter: state => state.whitePlayerFilter,
    blackPlayerFilter: state => state.blackPlayerFilter,
    resultFilter: state => state.resultFilter,
}

const mutations = {
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
    setGamesAreLoading(state, val) {
        state.areGamesLoading = val;
    },
    makeMoveFromPopularMoves(state, san) {
        let game = state.game;
        game.move(san);

        let activeMove = parseInt(state.activeMove) + 1;
        let gameHistory = game.history();
        let pgn = game.pgn();

        if (!activeMove) {
            activeMove = 0;
        }

        this.dispatch('changePgn', pgn);
        this.dispatch('calculateNewPosition', {gameHistory, activeMove});
    },
    setWhitePlayerFilter(state, filter) {
        state.whitePlayerFilter = filter;
    },
    setBlackPlayerFilter(state, filter) {
        state.blackPlayerFilter = filter;
    },
    setResultFilter(state, filter) {
        state.resultFilter = filter;
    },
}

const actions = {
    makeMoveFromPopularMoves(state, san){
        state.commit('makeMoveFromPopularMoves', san);
    },
    calculateNewPosition(state, {gameHistory, activeMove}) {
        let game = new Chess();

        let i=0;
        while (i < (activeMove + 1)) {
            game.move(gameHistory[i]);

            if (i == activeMove) {
                let fen = game.fen();

                state.commit('setGame', game);
                state.commit('saveFen', fen);
                state.commit('changeBoardPosition', fen);
                state.dispatch('getMostPopularMovesInThePosition', fen);
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
        state.dispatch('getMostPopularMovesInThePosition');
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
    changePgn(state, pgn) {
        state.commit('changePgn', pgn);
    },
    loadGame(state, payload) {
        state.commit('setActiveGameRow', payload.id);
        state.commit('changePgn', payload.pgn);
        state.commit('calculateFen', payload.pgn);
        state.commit('changeBoardPosition', state.getters.getFen);
        state.commit('changeMostPopularMoves', []);
        state.commit('setMoveButtons', true);
    },
    getMostPopularMovesInThePosition(state, fen = 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1') {
        state.commit('changeMostPopularMoves', false);

        return axios.post(Routing.generate('ajax_get_popular_moves'), {
            fenString:fen
        })
            .then(response => {
                let respArray = [];
                let data = response.data;

                for (let key in data) {
                    let move = {};
                    move.moveSan = key;
                    move.moveCount = data[key].count_sum;
                    move.moveCountWhiteWin = data[key].count_white_win;
                    move.moveCountBlackWin = data[key].count_black_win;
                    move.moveCountDraw = data[key].count_draw;

                    respArray.push(move)
                }

                state.commit('changeMostPopularMoves', respArray);
            })
            .catch(error => console.log(error))
            .finally();
    },
    updateGame(state, payload) {
        return axios.post(Routing.generate('ajax_update_game'), {
            id:payload.id,
            flag:payload.flag,
        })
            .then(response => {

            })
            .catch(error => console.log(error))
            .finally();
    }
}

export default {
    state,
    getters,
    actions,
    mutations
};
