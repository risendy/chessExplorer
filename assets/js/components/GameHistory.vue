<template>
  <div class="card card_info">

    <div class="card-body" style="padding-bottom: 0px">
      <h5> Game history:

      </h5>
    </div>

    <div class="card-body card_body_graph">
      <span id="pgnPlaceholder" v-html="currentGameState"></span>
      <div>
        <button id="prevBtn" v-on:click="prevMove">prev</button>
        <button id="nextBtn" v-on:click="nextMove">next</button>
      </div>
    </div>
  </div>
</template>

<script>
import Store from "../store/store";

export default {
  name: "GameHistory",
  data: function () {
    return {
        currentPgn: ''
    }
  },
  computed: {
    currentGameState: function () {
      return this.$store.getters.getPgn
    },
  },
  methods: {
    prevMove: function (event) {
        this.$store.dispatch('prevMove')
    },
    nextMove: function (event) {
        this.$store.dispatch('nextMove')
    },
  },
};
</script>