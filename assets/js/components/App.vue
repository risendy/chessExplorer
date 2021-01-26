<template>
<div id="app">
<div class="container-fluid">

  <div class="starter-template">
    <div class="row center">
      <div class="col-sm-3 col-md-3 col-lg-3">
        <GameHistory/>
      </div>
      <div class="col-sm-5 col-md-5 col-xs-12">
        <div id="board"></div>
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
import Store from '../store/store.js'

export default {
  name: "AppMain",
  data: function () {
    return {
        test: 1
    }
  },
  computed: {

  },
  components: {
    GameHistory,
    GameTable
  },
  methods: {},
  mounted: function () {
    this.$store.commit('setInitBoard');
    this.$store.commit('setInitGame');
  }
};
</script>