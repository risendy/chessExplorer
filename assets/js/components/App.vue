<template>
<div id="app">
<div class="container-fluid">

  <div class="starter-template">
    <div class="row center">
      <div class="col-sm-3 col-md-3 col-lg-3">
        <GameHistory/>
        <PossibleMoves/>
      </div>
      <div class="col-sm-5 col-md-5 col-xs-12">
        <div id="board"></div>
        <GameButtons/>
      </div>
      <div class="col-sm-4 col-md-4 col-lg-4">
        <GameTable/>
      </div>
    </div>
  </div>

</div>
</div><!-- /.container -->
</template>

<script>
import GameHistory from './GameHistory.vue'
import GameTable from './GameTable.vue'
import PossibleMoves from "./PossibleMoves";
import GameButtons from "./GameButtons";
import * as Func from '../modules/functions.js';
import * as Ajax from '../modules/ajaxCalls.js';

export default {
  name: "AppMain",
  data: function () {
    return {

    }
  },
  computed: {

  },
  components: {
    PossibleMoves,
    GameHistory,
    GameTable,
    GameButtons
  },
  methods: {},
  mounted: function () {
    this.$store.commit('setInitGame');

    var config = {
      draggable: true,
      position: 'start',
      onDragStart: Func.onDragStart,
      onDrop: Func.onDrop,
      onSnapEnd: Func.onSnapEnd
    }

    this.$store.commit('setInitBoard', config);

    Ajax.getMostPopularMovesInThePosition();
  }
};

</script>