import store from "../store/index.js";

export function onDragStart (source, piece, position, orientation) {
    let game = store.getters.getGame;

    // do not pick up pieces if the game is over
    //if (Store.getters.getGame.game_over()) return false

    // only pick up pieces for the side to move
    if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
        (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
        return false
    }
}

export function onDrop (source, target) {
    let game = store.getters.getGame;

    // see if the move is legal
    var move = game.move({
        from: source,
        to: target,
        promotion: 'q' // NOTE: always promote to a queen for example simplicity
    })

    let newFen = game.fen();
    let pgn = game.pgn();

    store.dispatch('getMostPopularMovesInThePosition', newFen);
    store.commit('changePgn', pgn);

    // illegal move
    if (move === null) return 'snapback'
}

// update the board position after the piece snap
// for castling, en passant, pawn promotion
export function onSnapEnd () {
    let game = store.getters.getGame;

    store.commit('changeBoardPosition', game.fen());
}
