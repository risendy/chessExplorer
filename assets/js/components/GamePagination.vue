<template>
  <ul class="pagination">
    <li @click="firstPage" class="page-item" v-bind:class="{ active: activeFirst}"><a class="page-link" href="#">1</a></li>
    <li v-if="gamesDb.page > 1" @click="previousPage" class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li v-if="gamesDb.page" @click="nextPage" class="page-item"><a class="page-link" href="#">Next</a></li>
    <li v-if="gamesDb.totalPages > 1" @click="lastPage" class="page-item" v-bind:class="{ active: activeLast}"><a class="page-link" href="#">{{ gamesDb.totalPages }}</a></li>
  </ul>
</template>

<script>
import axios from "axios";
import {createInstance} from 'vuex-pagination'
import GameListTable from "./GameListTable";
import GameFilters from "./GameFilters";

export default {
  name: "GamePagination",
  data: function () {
    return {
      activeFirst: true,
      activeLast: false,
      title: ''
    }
  },
  methods: {
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

  },
  mounted () {

  }
};
</script>
