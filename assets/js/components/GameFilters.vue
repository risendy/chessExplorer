<template>
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
</template>

<script>
import axios from "axios";
import {createInstance} from 'vuex-pagination'
import GameListTable from "./GameListTable";

export default {
  name: "GameFilters",
  data: function () {
    return {

    }
  },
  methods: {

  },
  computed: {
    whitePlayerFilter: {
      get () {
        return this.$store.getters.whitePlayerFilter;
      },
      set (value) {
        this.$store.commit('setWhitePlayerFilter', value)
      }
    },
    blackPlayerFilter: {
      get () {
        return this.$store.getters.blackPlayerFilter;
      },
      set (value) {
        this.$store.commit('setBlackPlayerFilter', value)
      }
    },
    resultFilter: {
      get () {
        return this.$store.getters.resultFilter;
      },
      set (value) {
        this.$store.commit('setResultFilter', value)
      }
    },
  },
  mounted () {

  }
};
</script>
