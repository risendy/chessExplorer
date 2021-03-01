<template>
  <div id="box">
  <div class="card card_info">

    <div class="card-body">
      <h5> <i class="bi bi-list"></i>
         Games:
      </h5>

      <game-filters> </game-filters>

      <b-tabs content-class="mt-2">
        <b-tab title="Games" active>
          <template #title>
            <i class="bi bi-list"></i> Games
          </template>

          <game-list-table></game-list-table>
        </b-tab>
        <b-tab title="Favourites">
          <template #title>
            <i class="bi bi-star"></i> Favourite
          </template>

          <games-favourite></games-favourite>
        </b-tab>
      </b-tabs>
    </div>
  </div>
  </div>
</template>

<script>
import axios from "axios";
import {createInstance} from 'vuex-pagination'
import GameListTable from "./GameListTable";
import GameFilters from "./GameFilters";
import GamesFavourite from "./FavouriteGames";

export default {
  name: "GameTable",
  components: {GamesFavourite, GameFilters, GameListTable},
  data: function () {
    return {

    }
  },
  methods: {

  },
  computed: {

  },
  mounted () {

  }
};
</script>
