<template>
  <div class="card card_info left-upper-box">

    <div class="row">
    <div class="card-body" style="padding-bottom: 15px">
      <h5> Game history:</h5>
    </div>
    </div>

    <div class="row">
    <table class="table table-striped" style="table-layout: fixed;">
      <thead>
      <tr>
        <th>move</th>
        <th>white</th>
        <th>black</th>
      </tr>
      </thead>
      <tbody>
      <template v-for="(move, key, index) in pgnArray">
        <tr class="game-moves">
          <td>{{key + 1}}</td>
          <td @click="loadMoves" :data-move-san="move.white" :data-move-number="move.idWhite" :class="{ activeMove: (activeMove == move.idWhite) }">{{move.white}}</td>
          <td @click="loadMoves" :data-move-san="move.black" :data-move-number="move.idBlack" :class="{ activeMove: (activeMove == move.idBlack) }">{{move.black}}</td>
        </tr>
      </template>

      </tbody>
    </table>
    </div>

  </div>
</template>

<script>
import * as Chess from "../../chess";
import * as Ajax from '../modules/ajaxCalls.js';

export default {
  name: "GameHistory",
  data: function () {
    return {
      currentPgn: '',
      moves: [],
      move_history: []
    }
  },
  computed: {
    activeMove: function () {
      return this.$store.getters.activeMove;
    },
    currentGameState: function () {
      return this.$store.getters.getPgn;
    },
    buttonsVisible: function () {
      return this.$store.getters.getMovePositionButtonsVisible;
    },
    pgnArray: function () {
      let game = new Chess();
      var resultArray = [];
      let pgn = this.$store.getters.getPgn;

      if (pgn) {
        game.load_pgn(pgn);

        let history = game.history({verbose: true});
        let gameHistoryMovesArray = game.history();

        this.$store.dispatch('setGameHistory', gameHistoryMovesArray);

        console.log(this.move_history);

        let gameHeaders = game.header();
        let gameResult = gameHeaders.Result;
        let turn = 1;

        for (var i=0; i<history.length; i++) {
            //white
            if (i % 2 == 0) {
              var move = {};
              move.idWhite = i;
              move.turn = turn;
              move.white = history[i].san;

              if (i == history.length - 1) {
                resultArray.push(move);
                turn++;
              }
            }
            //black
            else
            {
              move.idBlack = i;
              move.black = history[i].san;

              resultArray.push(move);
              turn++;
            }
        }

        let lastIndexInMoveArray = resultArray[resultArray.length - 1];

        if (lastIndexInMoveArray) {
          //last move is black
          if (lastIndexInMoveArray.black) {
            this.$store.dispatch('setActiveMove', lastIndexInMoveArray.idBlack);

            if (gameResult){
              var move = {};
              move.turn = turn;
              move.white = gameResult;
              resultArray.push(move);
            }

          }
          //last move is white
          else
          {
            this.$store.dispatch('setActiveMove', lastIndexInMoveArray.idWhite);
            if (gameResult) move.black = gameResult;
          }
        }
      }

      return resultArray;
    }
  },
  methods: {
    calculateFen(san, moveNumber) {
      let gameHistory = this.$store.getters.gameHistory;
      let game = new Chess();

      let i=0;
      while (i < (moveNumber + 1)) {
        game.move(gameHistory[i]);

        if (i == moveNumber) {
            this.$store.dispatch('setGame', game);
            return game.fen();
        }
        i++;
      }

      return false;
    },

    loadMoves: function (event) {
      let san = event.currentTarget.getAttribute('data-move-san');
      let activeMove = parseInt(event.currentTarget.getAttribute('data-move-number'));
      let gameHistory = this.$store.getters.gameHistory;

      this.$store.dispatch('calculateNewPosition', {gameHistory, activeMove})
      this.$store.dispatch('setActiveMove', activeMove);
     }
  },
};
</script>
