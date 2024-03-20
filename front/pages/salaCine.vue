User
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
      >
        <!-- Número de butaca oculto -->
        <span class="hidden">{{ seat }}</span>
      </div>
    </div>
    <div class="purchase-info">
      <h3>Butacas seleccionadas:</h3>
      <ul>
        <li v-for="(seat, index) in selectedSeats" :key="index">
          Butaca {{ seat }} - Precio: {{ precioButaca }}€
        </li>
      </ul>
      <p>Total: {{ totalEntradas }}€</p>
      <button @click="goToTicketroom" :disabled="selectedSeats.length === 0">Confirmar compra</button>
    </div>
  </div>
</template>

<script>
import { usePeliculaDestacadaStore } from '~/stores/peliculaDestacadaStore.js';
import { useRouter } from 'vue-router'; // Asegúrate de importar el router si no lo has hecho aún

export default {
  data() {
    return {
      selectedSeats: [],
      movie: null,
      precioButaca: 10, // Precio por defecto
    };
  },
  computed: {
    totalEntradas() {
      return this.selectedSeats.length * this.precioButaca;
    },
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
    goToTicketroom() {
      const router = useRouter(); // Obtén el objeto router
      router.push('/salaCine');
    }
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
  display: flex;
  align-items: center;
  justify-content: center;
}

.seat.selected {
  background-color: green;
}

/* Texto en blanco */
.seat span {
  color: white;
}

/* Clase para ocultar el número de butaca */
.hidden {
  display: none;
}

.purchase-info {
  color: white;
  margin-top: 20px;
}

h3 {
  color: white;
}
</style>