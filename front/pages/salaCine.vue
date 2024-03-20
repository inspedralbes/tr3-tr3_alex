<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <div class="row" v-for="row in 10" :key="row">
      <div
        class="seat"
        v-for="seat in 12"
        :key="seat"
        :class="{ 'selected': isSelected(row, seat) }"
        @click="selectSeat(row, seat)"
        @mouseover="hoverSeat(row, seat, true)"
        @mouseleave="hoverSeat(row, seat, false)"
      ></div>
    </div>
  </div>
</template>

<script>
import { usePeliculaDestacadaStore } from '~/store/peliculaDestacadaStore.js';

export default {
  data() {
    return {
      selectedSeats: [],
      movie: null,
    };
  },
  mounted() {
    const peliculaDestacadaStore = usePeliculaDestacadaStore();
    this.movie = peliculaDestacadaStore.peliculaDestacada;
  },
  methods: {
    selectSeat(row, seat) {
      const seatId = `${row}-${seat}`;
      const index = this.selectedSeats.indexOf(seatId);
      if (index === -1 && this.selectedSeats.length < 10) {
        this.selectedSeats.push(seatId);
      } else if (index !== -1) {
        this.selectedSeats.splice(index, 1);
      }
    },
    isSelected(row, seat) {
      return this.selectedSeats.includes(`${row}-${seat}`);
    },
    hoverSeat(row, seat, isHovering) {
      // Aquí puedes implementar lógica adicional para el evento hover si lo deseas
    },
  },
};
</script>

<style scoped>
.cinema-container {
  background-color: black;
  padding: 20px;
  display: flex;
  flex-direction: column;
}

.row {
  display: flex;
  justify-content: center;
}

.seat {
  width: 30px;
  height: 30px;
  margin: 5px;
  cursor: pointer;
  background-color: grey;
}

.seat.selected {
  background-color: green;
}
</style>
