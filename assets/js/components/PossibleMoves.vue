<template>
  <div class="card card_info left-lower-box">

    <div class="row">
      <div class="card-body" style="padding-bottom: 15px">
        <h5> <i class="bi bi-list"></i>
           Most popular moves:</h5>
      </div>
    </div>

    <table v-if="possibleMoves" class="table" style="table-layout: fixed;">
      <thead>
      <tr>
        <th>lp</th>
        <th>move</th>
        <th>times</th>
        <th class="possible-move-game-result-header">white/draw/black</th>
      </tr>
      </thead>
      <tbody>
      <template v-for="(move, key, index) in possibleMoves">
        <tr class="possible-move-row" @click="makePossibleMove(move.moveSan)">
          <td>{{key + 1}}</td>
          <td>{{move.moveSan}}</td>
          <td>{{move.moveCount}}</td>
          <td>
            <span v-if="move.moveCountWhiteWin"><i class="bi bi-hexagon"></i> {{move.moveCountWhiteWin}}%</span>
            <span v-if="move.moveCountDraw"><i class="bi bi-hexagon-half"></i> {{move.moveCountDraw}}%</span>
            <span v-if="move.moveCountBlackWin"><i class="bi bi-hexagon-fill"></i> {{move.moveCountBlackWin}}%</span>
          </td>
        </tr>
      </template>
      </tbody>
    </table>
    <table v-else class="table" style="table-layout: fixed;">
      <div class="d-flex justify-content-center">
        <div class="spinner-grow text-success " role="status"></div>
      </div>
    </table>

  </div>
</template>

<script>
import * as Chess from "../../chess";

export default {
  name: "PossibleMoves",
  data: function () {
    return {
        currentPgn: ''
    }
  },
  computed: {
    possibleMoves: function () {
        return this.$store.getters.getPossibleMoves;
    }
  },
  methods: {
    makePossibleMove(san) {
      this.$store.dispatch('makeMoveFromPopularMoves', san);
    }
  },
};
</script>
