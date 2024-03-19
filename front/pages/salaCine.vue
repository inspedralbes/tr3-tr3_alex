<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <h2>Película Seleccionada: {{ peliculaTitulo }}</h2>
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
  props: {
    peliculaTitulo: {
      type: String,
      required: true
    },
    isSelected: {
      type: Function,
      required: true
    }
  },
  methods: {
    selectSeat(row, seat) {
      // Implementa la lógica para seleccionar un asiento
    },
    hoverSeat(row, seat, isHovering) {
      // Implementa la lógica para el evento hover
    }
  }
};
</script>

<style>
.cinema-container {
  background-color: black;
  padding: 20px;
  display: flex;
  flex-direction: column; /* Asegura que las filas se apilen verticalmente */
}

.row {
  display: flex;
  justify-content: center; /* Centra los asientos en su fila */
}

.seat {
  width: 30px;
  height: 30px;
  margin: 5px;
  cursor: pointer;
  background-color: grey; /* Considera quitar esto si el SVG cubre el asiento completamente */
  background-image: url('path_to_your_seat_icon.svg'); /* Añade tu imagen SVG aquí */
  background-size: cover; /* Asegura que el SVG cubra el asiento */
}

.seat.selected, .seat:hover {
  background-color: green; /* Ajusta según necesites */
}
</style>
