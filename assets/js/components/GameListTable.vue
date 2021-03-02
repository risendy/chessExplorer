<template>
  <div>
  <game-sort></game-sort>

  <table v-if="!isLoading && gamesDb.items.length > 0" class="table table-striped" style="table-layout: fixed;">
    <thead>
    <tr>
      <th class="date-table-header">date</th>
      <th class="white-table-header">white</th>
      <th class="black-table-header">black</th>
      <th class="result-table-header">result</th>
      <th class="result-table-header">options</th>
    </tr>
    </thead>
    <tbody>
    <template v-for="game in gamesDb.items">
      <tr v-on:click="loadGame" :data-pgn="game.pgn" :data-id="game.id" :class="{ 'table-success': (activeGameRow == game.id) }">
        <td>{{game.date}}</td>
        <td>{{game.white}}</td>
        <td>{{game.black}}</td>
        <td>{{game.result}}</td>
        <td v-on:click.stop="">
          <span
              :class="{ 'span-favourite': game.favourite }"
              class="favIconSpan"
              v-on:click="addGameToFavourites"
              v-b-tooltip.hover
              :data-id="game.id"
              :data-flag="game.favourite"
              :title="(game.favourite) ? 'Delete from favourites' : 'Add to favourites'"
              >
            <i class="bi bi-star-fill"></i>
          </span>
        </td>
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

  <table v-else-if="!isLoading && gamesDb.items.length == 0" class="table table-striped" style="table-layout: fixed;">
    <div class="alert alert-success" role="alert">
      No games found...
    </div>
  </table>

  <table v-else class="table table-striped" style="table-layout: fixed;">
    <div class="d-flex justify-content-center">
      <div class="spinner-grow text-success " role="status"></div>
    </div>
  </table>
  </div>
</template>

<script>
import axios from "axios";
import {createInstance} from 'vuex-pagination'
import {favouriteGames, games} from "../game";
import GameSort from "./GameSort";

export default {
  name: "GameListTable",
  components: {GameSort},
  data: function () {
    return {
      eloWhiteFromFilter: '',
      eloWhiteToFilter: '',
      eloBlackFromFilter: '',
      eloBlackToFilter: '',
      sortOption: 'name_asc',
      games: [],
      errors: [],
      activeFirst: true,
      activeLast: false,
      title: ''
    }
  },
  methods: {
    addGameToFavourites: function (event) {
      this.$store.dispatch('updateGame', {
        id: event.currentTarget.getAttribute('data-id'),
        flag: event.currentTarget.getAttribute('data-flag')
      }).then(
          games.refresh(),
          favouriteGames.refresh()
      );
    },
    loadGame: function (event) {
      this.$store.dispatch('loadGame', {
          id: event.currentTarget.getAttribute('data-id'),
          pgn: event.currentTarget.getAttribute('data-pgn')
      });
    },
    firstPage: function (event) {
      this.gamesDb.page = 1;
      this.activeFirst = true
      this.activeLast = false
    },
    nextPage: function (event) {
      this.activeFirst = false
      this.activeLast = false

      //this.gamesDb.page++;
      this.$store.commit('incrementPage');

      if (this.gamesDb.page === this.gamesDb.totalPages) {
        this.activeLast= true
      }
    },
    previousPage: function (event) {
      this.activeFirst = false
      this.activeLast = false

      //this.gamesDb.page--;
      this.$store.commit('decrementPage');

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
        result.whitePlayerFilter = this.$store.getters.whitePlayerFilter;
        result.blackPlayerFilter = this.$store.getters.blackPlayerFilter;
        result.resultFilter = this.$store.getters.resultFilter;
        result.sortOption = this.$store.getters.sortOption;

        return result;
      }
    }),
    activeGameRow: function () {
      return this.$store.getters.activeGameRow;
    },
    isLoading: function () {
      return this.$store.getters.areGamesLoading;
    },
  },
  mounted () {

  }
};
</script>
