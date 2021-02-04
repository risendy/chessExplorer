import store from "../store/store";
import * as Ajax from '../modules/ajaxCalls.js';

export function onDragStart (source, piece, position, orientation) {
    let game = store.state.game;

    // do not pick up pieces if the game is over
    //if (Store.getters.getGame.game_over()) return false

    // only pick up pieces for the side to move
    if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
        (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
        return false
    }
}

export function onDrop (source, target) {
    let game = store.state.game;

    // see if the move is legal
    var move = game.move({
        from: source,
        to: target,
        promotion: 'q' // NOTE: always promote to a queen for example simplicity
    })

    let newFen = game.fen();
    let pgn = game.pgn();

    Ajax.getMostPopularMovesInThePosition(newFen);

    store.state.pgnState = pgn;

    // illegal move
    if (move === null) return 'snapback'
}

// update the board position after the piece snap
// for castling, en passant, pawn promotion
export function onSnapEnd () {
    let game = store.state.game;

    store.state.board.position(game.fen());
}

export function makeSelectedGameBold(id) {
    $("tr").removeClass('activeGame');
    $("tr[data-id='" + id +"']").addClass('activeGame');
}