<template>
  <div class="row">
    <div class="col-9">
    </div>
    <div class="col text-right">
      <form class="form">
        <div class="form-group">
          <select v-model="sortOption" id="exampleInputName2" class="form-control">
            <option value="date_asc">Date ASC</option>
            <option value="date_desc">Date DESC</option>
          </select>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {createInstance} from 'vuex-pagination'
import GameListTable from "./GameListTable";

export default {
  name: "GameSort",
  data: function () {
    return {

    }
  },
  methods: {

  },
  computed: {
    sortOption: {
      get () {
        return this.$store.getters.sortOption;
      },
      set (value) {
        this.$store.commit('setSortOption', value)
      }
    },
  },
  mounted () {

  }
};
</script>
