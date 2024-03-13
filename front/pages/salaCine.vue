<template>
  <div class="cinema-container" style="margin-top: 53px;">
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
export default {
  data() {
    return {
      // Inicialmente, todos los asientos están no seleccionados
      selectedSeats: [],
    };
  },
  methods: {
    selectSeat(row, seat) {
      const seatId = `${row}-${seat}`;
      const index = this.selectedSeats.indexOf(seatId);
      if (index === -1) {
        this.selectedSeats.push(seatId);
      } else {
        this.selectedSeats.splice(index, 1);
      }
    },
    isSelected(row, seat) {
      return this.selectedSeats.includes(`${row}-${seat}`);
    },
    hoverSeat(row, seat, isHovering) {
      // Puedes implementar lógica adicional para el evento hover si lo deseas
    },
  },
};
</script>

<style>
.cinema-container {
  background-color: black;
  padding: 20px;
  display: flex;
  flex-wrap: wrap;
}
.row {
  display: flex;
}
.seat {
  width: 30px;
  height: 30px;
  margin: 5px;
  background-color: grey;
  cursor: pointer;
}
.seat.selected, .seat:hover {
  background-color: green;
}
</style>
