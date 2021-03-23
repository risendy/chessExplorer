import axios from "axios";

export async function getGameInfoModal(gameId) {
    const game = await axios.post(Routing.generate('ajax_get_game_info'), {
        gameId:gameId,
    })
        .then(response => {
            return response.data;
        })
        .catch(error => console.log(error))
        .finally();

    return {
        white: game.white,
        whiteElo: game.whiteElo,
        black: game.black,
        blackElo: game.blackElo,
        result: game.result,
        event: game.event,
        date: game.date,
        eventDate: game.eventDate,
        pgn: game.pgn,
    }
}
