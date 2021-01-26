<template>
  <div id="box">
  <div class="card card_info">

    <div class="card-body">
      <h5> Games:

      </h5>

      <table class="table">
        <thead>
        <tr>
          <th>date</th>
          <th>white</th>
          <th>elo</th>
          <th>black</th>
          <th>elo</th>
          <th>result</th>
        </tr>
        </thead>
        <tbody>
          <template v-for="game in games">
            <tr v-on:click="loadGame" :data-pgn="game.pgn">
              <td>{{game.date}}</td>
              <td>{{game.white}}</td>
              <td>{{game.whiteElo}}</td>
              <td>{{game.black}}</td>
              <td>{{game.blackElo}}</td>
              <td>{{game.result}}</td>
            </tr>
          </template>
        </tbody>
      </table>

    </div>
  </div>
  </div>
</template>

<script>
import axios from "axios";
import Store from '../store/store.js'

export default {
  name: "GameTable",
  data: function () {
    return {
      games: [],
      errors: []
    }
  },
  methods: {
    loadGame: function (event) {
      let pgn = event.currentTarget.getAttribute('data-pgn');
      this.$store.commit('changePgn', pgn);
      this.$store.commit('calculateFen', pgn);

      let fen = this.$store.getters.getFen;

      this.$store.commit('changeBoardPosition', fen);
    }
  },
  mounted () {
    var url = Routing.generate('ajax_get_games');

    axios.get(url)
        .then(response => {
          this.games = response.data.games
        })
        .catch(e => {
          this.errors.push(e)
        })
  }
};
</script>