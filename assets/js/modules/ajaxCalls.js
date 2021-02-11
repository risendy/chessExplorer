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
            var respArray = [];

            for (let i=0; i<response.data.length; i++) {
                let move = {};
                move.moveSan = response.data[i].next_move_san;
                move.moveCount = response.data[i].numer_of_moves;

                respArray.push(move);
            }

            store.state.possibleMoves = respArray;
        })
        .catch(error => console.log(error))
        .finally();
}
