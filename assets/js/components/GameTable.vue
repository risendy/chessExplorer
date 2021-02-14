<template>
  <div id="box">
  <div class="card card_info">

    <div class="card-body">
      <h5> <i class="bi bi-list"></i>
         Games:
      </h5>

      <form>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label"><i class="bi bi-hexagon"></i> White</label>
          <div class="col-sm-10">
            <input v-model="whitePlayerFilter" type="string" class="form-control" id="inputEmail3" placeholder="start typing...">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label"><i class="bi bi-hexagon-fill"></i> Black</label>
          <div class="col-sm-10">
            <input v-model="blackPlayerFilter" type="string" class="form-control" id="inputEmail3" placeholder="start typing...">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label"><i class="bi bi-check-square"></i> Result</label>
          <div class="col-sm-10">
            <input v-model="resultFilter" type="string" class="form-control" id="inputEmail3" placeholder="start typing...">
          </div>
        </div>
      </form>

      <table class="table table-striped" style="table-layout: fixed;">
        <thead>
        <tr>
          <th class="date-table-header">date</th>
          <th class="white-table-header">white</th>
          <th class="black-table-header">black</th>
          <th class="result-table-header">result</th>
        </tr>
        </thead>
        <tbody>
          <template v-for="game in gamesDb.items">
            <tr v-on:click="loadGame" :data-pgn="game.pgn" :data-id="game.id" :class="{ activeGame: (activeGameRow == game.id) }">
              <td>{{game.date}}</td>
              <td>{{game.white}}</td>
              <td>{{game.black}}</td>
              <td>{{game.result}}</td>
            </tr>
          </template>

            <ul class="pagination">
              <li @click="firstPage" class="page-item" v-bind:class="{ active: activeFirst}"><a class="page-link" href="#">1</a></li>
              <li v-if="gamesDb.page > 1" @click="previousPage" class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li v-if="gamesDb.page < gamesDb.totalPages" @click="nextPage" class="page-item"><a class="page-link" href="#">Next</a></li>
              <li v-if="gamesDb.totalPages > 1" @click="lastPage" class="page-item" v-bind:class="{ active: activeLast}"><a class="page-link" href="#">{{ gamesDb.totalPages }}</a></li>
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
      eloWhiteFromFilter: '',
      eloWhiteToFilter: '',
      eloBlackFromFilter: '',
      eloBlackToFilter: '',
      whitePlayerFilter: '',
      blackPlayerFilter: '',
      resultFilter: '',
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
      pageSize: 10,
      args () {
        let result = {};
        result.whitePlayerFilter = this.whitePlayerFilter;
        result.blackPlayerFilter = this.blackPlayerFilter;
        result.resultFilter = this.resultFilter;

        return result;
      }
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
