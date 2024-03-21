
<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <h1>{{ movie.titulo }}</h1>
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
      
      <button class="buy-ticket-button" @click="goToTicketroom"  :disabled="selectedSeats.length === 0" >Confirmar compra</button>
    </div>
  </div>
</template>

<script>

import { usePeliculaDestacadaStore } from '~/stores/peliculaDestacadaStore'
import { useRouter } from 'vue-router'

export default {
  data() {
    return {
      selectedSeats: [],
      precioButaca: 10, // Precio por defecto
    };
  },
  computed: {
    totalEntradas() {
      return this.selectedSeats.length * this.precioButaca;
    },
    movie(){
      const peliculaDestacadaStore = usePeliculaDestacadaStore();
      return peliculaDestacadaStore.peliculaDestacada;
    }
  },
  setup() {
    // const peliculaDestacadaStore = usePeliculaDestacadaStore()
    // console.log("Hail hitler");
    // this.movie = peliculaDestacadaStore.peliculaDestacada;
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
      const router = useRouter()
      router.push('/ticket');
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

.buy-ticket-button {
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* .buy-ticket-button:hover {
  background-color: #0056b3;
} */

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