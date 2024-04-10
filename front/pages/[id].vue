<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <h1>{{ movie.titulo }}</h1>
    <div class="row" v-for="(row, rowIndex) in seats" :key="rowIndex">
      <div class="seat" v-for="(seat, seatIndex) in row" :key="seatIndex"
        :class="{ 'selected': seat.selected, 'occupied': seat.occupied }" :disabled="seat.occupied"
        @click="selectSeat(rowIndex, seatIndex)">
        <span class="hidden">{{ seat.id }}</span>
      </div>
    </div>
    <div class="purchase-info">
      <h3>Butacas seleccionadas:</h3>
      <ul>
        <li v-for="(seat, index) in selectedSeats" :key="index">
          Butaca {{ seat.id }} - Precio: {{ precioButaca }}€
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
      precioButaca: 10,
      session: null,
      seats: [],
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
    // setInterval(this.fetchButacasOcupadas, 10000);
  },
  methods: {
    async fetchButacasOcupadas() {
      try {
        const peliculaStore = usePeliculaStore();
        const sessionId = peliculaStore.sesionID;
        const response = await fetch(`http://localhost:8000/api/sesiones-entradas/${sessionId}`);

        const data = await response.json();
        console.log('Datos de butacas ocupadas recibidos:', data);
        this.initializeSeats(data.entradas); // Llama a la función para inicializar los asientos ocupados
      } catch (error) {
        console.error('Error al obtener butacas ocupadas:', error);
      }
    },
    initializeSeats(entradas) {
      const rows = 10; // Número de filas
      const seatsPerRow = 12; // Número de asientos por fila
      for (let i = 1; i <= rows; i++) {
        const row = [];
        for (let j = 1; j <= seatsPerRow; j++) {
          const id = `${i}-${j}`;
          const occupied = entradas.some(entrada => {
            if (entrada.Butaca === id) { // Comparar con el formato completo de la butaca
              console.log(`Asiento ${id} está ocupado`);
              return true;
            }
            return false;
          });
          row.push({ id, occupied, selected: false });
        }
        this.seats.push(row);
      }
    },
    selectSeat(rowIndex, seatIndex) {
      const seat = this.seats[rowIndex][seatIndex];
      if (!seat.occupied) {
        if (this.selectedSeats.length < 10) { // Verificar si ya se han seleccionado 10 entradas
          seat.selected = !seat.selected;
          const index = this.selectedSeats.findIndex(selectedSeat => selectedSeat === seat.id);
          if (index === -1) {
            this.selectedSeats.push(seat.id);
          } else {
            this.selectedSeats.splice(index, 1);
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
