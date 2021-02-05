<template>
  <div id="box">
  <div class="card card_info">

    <div class="card-body">
      <h5> Games:

      </h5>

      <table class="table table-striped" style="table-layout: fixed;">
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
          <template v-for="game in gamesDb.items">
            <tr v-on:click="loadGame" :data-pgn="game.pgn" :data-id="game.id" :class="{ activeGame: (activeGameRow == game.id) }">
              <td>{{game.date}}</td>
              <td>{{game.white}}</td>
              <td>{{game.whiteElo}}</td>
              <td>{{game.black}}</td>
              <td>{{game.blackElo}}</td>
              <td>{{game.result}}</td>
            </tr>
          </template>

            <ul class="pagination">
              <li @click="firstPage" class="page-item" v-bind:class="{ active: activeFirst}"><a class="page-link" href="#">1</a></li>
              <li v-if="gamesDb.page > 1" @click="previousPage" class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li v-if="gamesDb.page < gamesDb.totalPages" @click="nextPage" class="page-item"><a class="page-link" href="#">Next</a></li>
              <li @click="lastPage" class="page-item" v-bind:class="{ active: activeLast}"><a class="page-link" href="#">{{ gamesDb.totalPages }}</a></li>
            </ul>

        </tbody>
      </table>

    </div>
  </div>
  </div>
</template>

<script>
import axios from "axios";
import Store from '../store/store.js'
import {createInstance} from 'vuex-pagination'
import * as Func from '../modules/functions.js';

export default {
  name: "GameTable",
  data: function () {
    return {
      games: [],
      errors: [],
      activeFirst: true,
      activeLast: false
    }
  },
  methods: {
    loadGame: function (event) {
      let id = event.currentTarget.getAttribute('data-id');
      let pgn = event.currentTarget.getAttribute('data-pgn');

      this.$store.dispatch('setActiveGameRow', id);
      this.$store.commit('changePgn', pgn);
      this.$store.commit('calculateFen', pgn);

      let fen = this.$store.getters.getFen;

      this.$store.commit('changeBoardPosition', fen);
      this.$store.dispatch('clearPopularMoves');
      this.$store.dispatch('setMoveButtons', true);
    },
    firstPage: function (event) {
      this.gamesDb.page = 1;
      this.activeFirst = true
      this.activeLast = false
    },
    nextPage: function (event) {
      this.activeFirst = false
      this.activeLast = false

      this.gamesDb.page++;

      if (this.gamesDb.page === this.gamesDb.totalPages) {
        this.activeLast= true
      }
    },
    previousPage: function (event) {
      this.activeFirst = false
      this.activeLast = false

      this.gamesDb.page--;

      if (this.gamesDb.page === 1) {
        this.activeFirst = true
      }
    },
    lastPage: function (event) {
      this.activeFirst = false
      this.activeLast = true
      this.gamesDb.page = this.gamesDb.totalPages
    },
  },
  computed: {
    gamesDb: createInstance('games', {
      page: 1,
      pageSize: 10
    }),
    activeGameRow: function () {
      return this.$store.getters.activeGameRow;
    },
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