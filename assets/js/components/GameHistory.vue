<template>
  <div class="card card_info">

    <div class="card-body" style="padding-bottom: 0px">
      <h5> Game history:

      </h5>
    </div>

    <div class="card-body card_body_graph">
      <span id="pgnPlaceholder"></span>
      <div>
        <button class="btn btn-success" id="prevBtn" v-on:click="prevMove">prev</button>
        <button class="btn btn-success" id="nextBtn" v-on:click="nextMove">next</button>
      </div>
    </div>

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
        <tr>
          <td>{{key + 1}}</td>
          <td>{{move.white}}</td>
          <td>{{move.black}}</td>
        </tr>
      </template>

      </tbody>
    </table>

  </div>
</template>

<script>
import Store from "../store/store";
import * as Chess from "../../chess";

export default {
  name: "GameHistory",
  data: function () {
    return {
        currentPgn: '',
        moves: []
    }
  },
  computed: {
    currentGameState: function () {
      return this.$store.getters.getPgn
    },
    pgnArray: function () {
      let game = new Chess();
      var resultArray = [];
      let pgn = this.$store.getters.getPgn;
      let result = '';

      if (pgn) {
        game.load_pgn(pgn);

        let history = game.history({verbose: true});
        let result = game.result;

        let turn = 1;

        for (var i=0; i<history.length; i++) {
            //white
            if (i % 2 == 0) {
              var move = {};
              move.turn = turn;

              move.white = history[i].san;
            }
            //black
            else
            {
              move.black = history[i].san;

              resultArray.push(move);
              turn++;
            }
        }
      }

      return resultArray;
    }
  },
  methods: {
    prevMove: function (event) {
        this.$store.dispatch('prevMove')
    },
    nextMove: function (event) {
        this.$store.dispatch('nextMove')
    },
  },
};
</script>