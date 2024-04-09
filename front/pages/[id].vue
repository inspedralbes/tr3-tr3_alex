<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <h1>{{ movie.titulo }}</h1>
    <div class="row" v-for="row in 10" :key="row">
      <div class="seat"
           v-for="seat in 12"
           :key="seat"
           :class="[
             'seat',
             { 'selected': isSelected(row, seat) },
             { 'occupied': isOccupied(row, seat) }
           ]"
           @click="selectSeat(row, seat)"
           @mouseover="hoverSeat(row, seat, true)"
           @mouseleave="hoverSeat(row, seat, false)"
           :disabled="isOccupied(row, seat)">
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
      occupiedSeats: [],
      files: [ // Agrega el arreglo de asientos al objeto de datos
        [{ asiento: '1-1', seleccionado: false, ocupado: false }, { asiento: '1-2', seleccionado: false, ocupado: false }, { asiento: '1-3', seleccionado: false, ocupado: false }, { asiento: '1-4', seleccionado: false, ocupado: false }, { asiento: '1-5', seleccionado: false, ocupado: false }, { asiento: '1-6', seleccionado: false, ocupado: false }, { asiento: '1-7', seleccionado: false, ocupado: false }, { asiento: '1-8', seleccionado: false, ocupado: false }, { asiento: '1-9', seleccionado: false, ocupado: false }, { asiento: '1-10', seleccionado: false, ocupado: false }, { asiento: '1-11', seleccionado: false, ocupado: false }, { asiento: '1-12', seleccionado: false, ocupado: false }],
        [{ asiento: '2-1', seleccionado: false, ocupado: false }, { asiento: '2-2', seleccionado: false, ocupado: false }, { asiento: '2-3', seleccionado: false, ocupado: false }, { asiento: '2-4', seleccionado: false, ocupado: false }, { asiento: '2-5', seleccionado: false, ocupado: false }, { asiento: '2-6', seleccionado: false, ocupado: false }, { asiento: '2-7', seleccionado: false, ocupado: false }, { asiento: '2-8', seleccionado: false, ocupado: false }, { asiento: '2-9', seleccionado: false, ocupado: false }, { asiento: '2-10', seleccionado: false, ocupado: false }, { asiento: '2-11', seleccionado: false, ocupado: false }, { asiento: '2-12', seleccionado: false, ocupado: false }],
        [{ asiento: '3-1', seleccionado: false, ocupado: false }, { asiento: '3-2', seleccionado: false, ocupado: false }, { asiento: '3-3', seleccionado: false, ocupado: false }, { asiento: '3-4', seleccionado: false, ocupado: false }, { asiento: '3-5', seleccionado: false, ocupado: false }, { asiento: '3-6', seleccionado: false, ocupado: false }, { asiento: '3-7', seleccionado: false, ocupado: false }, { asiento: '3-8', seleccionado: false, ocupado: false }, { asiento: '3-9', seleccionado: false, ocupado: false }, { asiento: '3-10', seleccionado: false, ocupado: false }, { asiento: '3-11', seleccionado: false, ocupado: false }, { asiento: '3-12', seleccionado: false, ocupado: false }],
        [{ asiento: '4-1', seleccionado: false, ocupado: false }, { asiento: '4-2', seleccionado: false, ocupado: false }, { asiento: '4-3', seleccionado: false, ocupado: false }, { asiento: '4-4', seleccionado: false, ocupado: false }, { asiento: '4-5', seleccionado: false, ocupado: false }, { asiento: '4-6', seleccionado: false, ocupado: false }, { asiento: '4-7', seleccionado: false, ocupado: false }, { asiento: '4-8', seleccionado: false, ocupado: false }, { asiento: '4-9', seleccionado: false, ocupado: false }, { asiento: '4-10', seleccionado: false, ocupado: false }, { asiento: '4-11', seleccionado: false, ocupado: false }, { asiento: '4-12', seleccionado: false, ocupado: false }],
        [{ asiento: '5-1', seleccionado: false, ocupado: false }, { asiento: '5-2', seleccionado: false, ocupado: false }, { asiento: '5-3', seleccionado: false, ocupado: false }, { asiento: '5-4', seleccionado: false, ocupado: false }, { asiento: '5-5', seleccionado: false, ocupado: false }, { asiento: '5-6', seleccionado: false, ocupado: false }, { asiento: '5-7', seleccionado: false, ocupado: false }, { asiento: '5-8', seleccionado: false, ocupado: false }, { asiento: '5-9', seleccionado: false, ocupado: false }, { asiento: '5-10', seleccionado: false, ocupado: false }, { asiento: '5-11', seleccionado: false, ocupado: false }, { asiento: '5-12', seleccionado: false, ocupado: false }],
        [{ asiento: '6-1', seleccionado: false, ocupado: false }, { asiento: '6-2', seleccionado: false, ocupado: false }, { asiento: '6-3', seleccionado: false, ocupado: false }, { asiento: '6-4', seleccionado: false, ocupado: false }, { asiento: '6-5', seleccionado: false, ocupado: false }, { asiento: '6-6', seleccionado: false, ocupado: false }, { asiento: '6-7', seleccionado: false, ocupado: false }, { asiento: '6-8', seleccionado: false, ocupado: false }, { asiento: '6-9', seleccionado: false, ocupado: false }, { asiento: '6-10', seleccionado: false, ocupado: false }, { asiento: '6-11', seleccionado: false, ocupado: false }, { asiento: '6-12', seleccionado: false, ocupado: false }],
        [{ asiento: '7-1', seleccionado: false, ocupado: false }, { asiento: '7-2', seleccionado: false, ocupado: false }, { asiento: '7-3', seleccionado: false, ocupado: false }, { asiento: '7-4', seleccionado: false, ocupado: false }, { asiento: '7-5', seleccionado: false, ocupado: false }, { asiento: '7-6', seleccionado: false, ocupado: false }, { asiento: '7-7', seleccionado: false, ocupado: false }, { asiento: '7-8', seleccionado: false, ocupado: false }, { asiento: '7-9', seleccionado: false, ocupado: false }, { asiento: '7-10', seleccionado: false, ocupado: false }, { asiento: '7-11', seleccionado: false, ocupado: false }, { asiento: '7-12', seleccionado: false, ocupado: false }],
        [{ asiento: '8-1', seleccionado: false, ocupado: false }, { asiento: '8-2', seleccionado: false, ocupado: false }, { asiento: '8-3', seleccionado: false, ocupado: false }, { asiento: '8-4', seleccionado: false, ocupado: false }, { asiento: '8-5', seleccionado: false, ocupado: false }, { asiento: '8-6', seleccionado: false, ocupado: false }, { asiento: '8-7', seleccionado: false, ocupado: false }, { asiento: '8-8', seleccionado: false, ocupado: false }, { asiento: '8-9', seleccionado: false, ocupado: false }, { asiento: '8-10', seleccionado: false, ocupado: false }, { asiento: '8-11', seleccionado: false, ocupado: false }, { asiento: '8-12', seleccionado: false, ocupado: false }],
        [{ asiento: '9-1', seleccionado: false, ocupado: false }, { asiento: '9-2', seleccionado: false, ocupado: false }, { asiento: '9-3', seleccionado: false, ocupado: false }, { asiento: '9-4', seleccionado: false, ocupado: false }, { asiento: '9-5', seleccionado: false, ocupado: false }, { asiento: '9-6', seleccionado: false, ocupado: false }, { asiento: '9-7', seleccionado: false, ocupado: false }, { asiento: '9-8', seleccionado: false, ocupado: false }, { asiento: '9-9', seleccionado: false, ocupado: false }, { asiento: '9-10', seleccionado: false, ocupado: false }, { asiento: '9-11', seleccionado: false, ocupado: false }, { asiento: '9-12', seleccionado: false, ocupado: false }],
        [{ asiento: '10-1', seleccionado: false, ocupado: false }, { asiento: '10-2', seleccionado: false, ocupado: false }, { asiento: '10-3', seleccionado: false, ocupado: false }, { asiento: '10-4', seleccionado: false, ocupado: false }, { asiento: '10-5', seleccionado: false, ocupado: false }, { asiento: '10-6', seleccionado: false, ocupado: false }, { asiento: '10-7', seleccionado: false, ocupado: false }, { asiento: '10-8', seleccionado: false, ocupado: false }, { asiento: '10-9', seleccionado: false, ocupado: false }, { asiento: '10-10', seleccionado: false, ocupado: false }, { asiento: '10-11', seleccionado: false, ocupado: false }, { asiento: '10-12', seleccionado: false, ocupado: false }],
      ]
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
    setInterval(this.fetchButacasOcupadas, 10000);
  },
  methods: {
    async fetchButacasOcupadas() {
      try {
        console.log('Comenzando fetchButacasOcupadas...');
        const peliculaStore = usePeliculaStore();
        const sessionId = peliculaStore.sesionID;
        console.log('sessionId:', sessionId);
        const response = await fetch(`http://localhost:8000/api/sesiones-entradas/${sessionId}`);
        console.log('Response:', response);
        const data = await response.json();
        console.log('Data recibida:', data);
        peliculaStore.actualizarButacasOcupadas(data.entradas); // Llama a la función para actualizar las butacas ocupadas
        console.log('Butacas ocupadas actualizadas');
      } catch (error) {
        console.error('Error al obtener butacas ocupadas:', error);
      }
    },
    actualizarButacasOcupadas(entradas) {
      entradas.forEach(entrada => {
        const fila = entrada.Fila; // Renombramos el campo 'Fila' para mayor claridad
        const asiento = entrada.Butaca; // Cambiamos 'Butaca' por 'asiento' según el nuevo formato
        for (let fila of this.files) {
          for (let seient of fila) {
            if (seient.asiento === `${fila}-${asiento}`) { // Ajustamos la comparación con el nuevo formato
              seient.ocupado = true;
              break;
            }
          }
        }
      });
    }
    ,
    selectSeat(row, seat) {
      const seatId = `${row}-${seat}`;
      const index = this.selectedSeats.indexOf(seatId);
      if (index === -1 && this.selectedSeats.length < 10 && !this.isOccupied(row, seat)) {
        this.selectedSeats.push(seatId);
      } else if (index !== -1) {
        this.selectedSeats.splice(index, 1);
      }
    },
    isSelected(row, seat) {
      return this.selectedSeats.includes(`${row}-${seat}`);
    },
    isOccupied(row, seat) {
      for (let fila of this.files) {
        for (let seient of fila) {
          if (seient.asiento === `${row}-${seat}` && seient.ocupado) {
            return true;
          }
        }
      }
      return false;
    },
    hoverSeat(row, seat, isHovering) {
      // Aquí puedes implementar lógica adicional para el evento hover si lo deseas
    },
    goToTicketroom() {
      console.log('Butacas seleccionadas:', this.selectedSeats);
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
