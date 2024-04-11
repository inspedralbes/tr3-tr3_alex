<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <h1>{{ movie.titulo }}</h1>
    <div class="row" v-for="(row, rowIndex) in seats" :key="rowIndex">
      <div class="seat" v-for="(seat, seatIndex) in row" :key="seatIndex"
        :class="{ 'selected': seat.selected, 'occupied': seat.occupied }" :disabled="seat.occupied"
        @click="selectSeat(rowIndex, seatIndex, seat.id)">
        <span class="hidden">{{ seat.id }}</span>
      </div>
    </div>
    <div class="purchase-info">
      <h3>Butacas seleccionadas:</h3>
      <ul>
        <li v-for="(seatId, index) in selectedSeats" :key="index">
          Butaca {{ seatId }} - Precio: {{ precioButaca }}€
        </li>
      </ul>
      <p>Total: {{ totalEntradas }}€</p>
      <button class="buy-ticket-button" @click="goToTicketroom()" :disabled="selectedSeats.length === 0">Continuar
        compra</button>
    </div>
  </div>
</template>

<script>
import { usePeliculaStore } from '~/stores/peliculaStore'

export default {
  data() {
    return {
      selectedSeats: [],
      session: null,
      seats: [],
      precioButaca: 0,
    };
  },
  computed: {
    totalEntradas() {
      return this.selectedSeats.length * this.precioButaca;
    },
    movie() {
      const peliculaStore = usePeliculaStore();
      return peliculaStore.peliculas[this.$route.params.id] || {};
    }
  },
  mounted() {
    this.fetchButacasOcupadas();
  },
  methods: {
    async fetchButacasOcupadas() {
      try {
        const peliculaStore = usePeliculaStore();
        const sessionId = peliculaStore.sesionID;
        const response = await fetch(`http://localhost:8000/api/sesiones-entradas/${sessionId}`);
        const data = await response.json();
        this.initializeSeats(data.entradas);
        await this.fetchSessionData(sessionId);
      } catch (error) {
        console.error('Error al obtener butacas ocupadas:', error);
      }
    },
    async fetchSessionData(sessionId) {
  try {
    const response = await fetch(`http://localhost:8000/api/sesiones/${sessionId}`);
    const data2 = await response.json();
    this.precioButaca = data2.precio;
    const peliculaStore = usePeliculaStore();
    peliculaStore.actualizarPrecio(data2.precio); // Aquí actualizamos el precio en el store
  } catch (error) {
    console.error('Error al obtener los datos de la sesión:', error);
  }
},
    initializeSeats(entradas) {
      const rows = 10;
      const seatsPerRow = 12;
      for (let i = 1; i <= rows; i++) {
        const row = [];
        for (let j = 1; j <= seatsPerRow; j++) {
          const id = `${i}-${j}`;
          const occupied = entradas.some(entrada => entrada.Butaca === id);
          row.push({ id, occupied, selected: false });
        }
        this.seats.push(row);
      }
    },
    selectSeat(rowIndex, seatIndex, seatId) {
      const seat = this.seats[rowIndex][seatIndex];
      if (!seat.occupied) {
        if (this.selectedSeats.length < 10) {
          seat.selected = !seat.selected;
          if (!this.selectedSeats.includes(seatId)) {
            this.selectedSeats.push(seatId);
          } else {
            this.selectedSeats = this.selectedSeats.filter(id => id !== seatId);
          }
        } else {
          alert('Ya has seleccionado el máximo de 10 entradas.');
        }
      }
    },
    goToTicketroom() {
      this.$router.push({ path: `/ticket` });
      const peliculaStore = usePeliculaStore();
      peliculaStore.actualizarButacasOcupadas(this.selectedSeats);
    }
  }
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

.seat.occupied {
  background-color: red;
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

h1 {
  color: white;
  text-align: center;
}

h3 {
  color: white;
}
</style>
