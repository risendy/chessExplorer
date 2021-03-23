<template>
  <b-modal size="lg" id="bv-modal-example" title="Game info">
      <table class="table table-bordered" v-if="gameInfo">
        <tbody>
        <tr>
          <td>Event: </td>
          <td>
            {{gameInfo.event}}
          </td>
        </tr>
        <tr>
          <td>Event date: </td>
          <td>
            {{gameInfo.eventDate}}
          </td>
        </tr>
        <tr>
          <td>Game date: </td>
          <td>
            {{gameInfo.date}}
          </td>
        </tr>
        <tr>
          <td>White: </td>
          <td>
            {{gameInfo.white}}
          </td>
        </tr>
        <tr>
          <td>White elo: </td>
          <td>
            {{gameInfo.whiteElo}}
          </td>
        </tr>
        <tr>
          <td>Black: </td>
          <td>
            {{gameInfo.black}}
          </td>
        </tr>
        <tr>
          <td>Black elo: </td>
          <td>
            {{gameInfo.blackElo}}
          </td>
        </tr>
        <tr>
          <td>Game result: </td>
          <td>
            {{gameInfo.result}}
          </td>
        </tr>

        <tr>
          <td style="width: 25%">PNG: </td>
          <td>
            {{gameInfo.pgn}}
          </td>
        </tr>
        </tbody>
      </table>

    <template #modal-footer="{ hide }">
      <!-- Button with custom close trigger value -->
      <b-button size="lg" variant="outline-secondary" @click="hide('forget')">
        Close
      </b-button>
    </template>
  </b-modal>
</template>

<script>
import {getGameInfoModal} from "../common/apiService";

export default {
  name: "GameInfoModal",
  props: {
    gameId: null,
  },
  data: function () {
    return {
      gameInfo: null
    }
  },
  watch: {
    gameId: async function (gameId, oldVal) {
      if (gameId) {
        this.gameInfo = await getGameInfoModal(gameId);
      }
    }
  },
  methods: {

  },
};
</script>
