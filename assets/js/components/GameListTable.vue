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
              v-on:click="showGameInfoModal(game.id)"
              class="favIconSpan"
              v-b-tooltip.hover
              :data-id="game.id"
              :title="'Show game info'"
              style="margin-right: 5px;"
          >
            <i class="bi bi-info-circle icon"></i>
          </span>
          <span
              :class="{ 'span-favourite': game.favourite }"
              class="favIconSpan"
              v-on:click="addGameToFavourites"
              v-b-tooltip.hover
              :data-id="game.id"
              :data-flag="game.favourite"
              :title="(game.favourite) ? 'Delete from favourites' : 'Add to favourites'"
          >
            <i class="bi bi-star-fill icon"></i>
          </span>
        </td>
      </tr>
    </template>

    <game-pagination v-bind:gamesDb="gamesDb"></game-pagination>

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

  <game-info-modal v-bind:gameId="selectedGameInfoId"></game-info-modal>
  </div>
</template>

<script>
import {createInstance} from 'vuex-pagination'
import {favouriteGames, games} from "../game";
import GameSort from "./GameSort";
import GamePagination from "./GamePagination";
import GameInfoModal from "./GameInfoModal";

export default {
  name: "GameListTable",
  components: {GameInfoModal, GamePagination, GameSort},
  data: function () {
    return {
      eloWhiteFromFilter: '',
      eloWhiteToFilter: '',
      eloBlackFromFilter: '',
      eloBlackToFilter: '',
      sortOption: 'name_asc',
      games: [],
      errors: [],
      selectedGameInfoId: null
    }
  },
  methods: {
    addGameToFavourites: async function (event) {
      await this.$store.dispatch('updateGame', {
        id: event.currentTarget.getAttribute('data-id'),
        flag: event.currentTarget.getAttribute('data-flag')
      });

      favouriteGames.refresh();
      games.refresh();
    },
    showGameInfoModal: function(id) {
      this.selectedGameInfoId = id;
      this.$bvModal.show('bv-modal-example');
    },
    loadGame: function (event) {
      this.$store.dispatch('loadGame', {
          id: event.currentTarget.getAttribute('data-id'),
          pgn: event.currentTarget.getAttribute('data-pgn')
      });
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
