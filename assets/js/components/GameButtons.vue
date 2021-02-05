<template>
    <div class="well text-center gameNavigationButtons">
        <span v-if="buttonsVisible">
          <button class="btn btn-success" id="prevBtn" v-on:click="prevMove">prev</button>
          <button class="btn btn-success" id="nextBtn" v-on:click="nextMove">next</button>
        </span>

        <button class="btn btn-success" id="resetPosition" v-on:click="resetPosition">reset</button>
    </div>
</template>

<script>
export default {
  name: "GameButtons",
  data: function () {
    return {

    }
  },
  computed: {
    buttonsVisible: function () {
      return this.$store.getters.getMovePositionButtonsVisible;
    },
  },
  methods: {
    prevMove: function (event) {
      this.$store.dispatch('decrementActiveMove')
      this.$store.dispatch('prevMove')
    },
    nextMove: function (event) {
      this.$store.dispatch('incrementActiveMove')
      this.$store.dispatch('nextMove')
    },
    resetPosition: function (event) {
      this.$store.dispatch('resetPosition')
      this.$store.dispatch('setMoveButtons', false);
      this.$store.dispatch('setActiveGameRow', null);
    },
  },
};
</script>