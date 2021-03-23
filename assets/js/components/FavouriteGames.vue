<template>
  <div>
    <game-sort></game-sort>

  <table v-if="!isLoading && gamesFavDb.items.length > 0" class="table table-striped" style="table-layout: fixed;">
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
    <template v-if="gamesFavDb.items" v-for="game in gamesFavDb.items">
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

    <game-pagination v-bind:gamesDb="gamesFavDb"></game-pagination>

    </tbody>
  </table>
  </div>
</template>

<script>
import {createInstance} from 'vuex-pagination'
import {favouriteGames, games} from "../game";
import GameSort from "./GameSort";
import GamePagination from "./GamePagination";

export default {
  name: "GamesFavourite",
  components: {GamePagination, GameSort},
  data: function () {
    return {

    }
  },
  methods: {
    loadGame: function (event) {
      this.$store.dispatch('loadGame', {
        id: event.currentTarget.getAttribute('data-id'),
        pgn: event.currentTarget.getAttribute('data-pgn')
      });
    },
    addGameToFavourites: async function (event) {
      await this.$store.dispatch('updateGame', {
        id: event.currentTarget.getAttribute('data-id'),
        flag: event.currentTarget.getAttribute('data-flag')
      });

      favouriteGames.refresh(),
      games.refresh()
    }
  },
  computed: {
    gamesFavDb: createInstance('favouriteGames', {
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
