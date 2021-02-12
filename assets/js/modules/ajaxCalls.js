import axios from 'axios';
import store from "../store/store";

/**
 * Fetch most popular moves in the position
 * @param fen default start position
 * @returns {Promise<unknown>}
 */
export function getMostPopularMovesInThePosition (fen = 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1') {
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

            store.state.possibleMoves = respArray;
        })
        .catch(error => console.log(error))
        .finally();
}
