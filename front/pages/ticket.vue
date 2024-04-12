<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <h1>{{ movie.titulo }}</h1>

    <div class="movie-poster-container">
      <img :src="movie.poster" :alt="movie.titulo" class="movie-poster">
    </div>

    <div class="purchase-info">
      <h3>Butacas Seleccionadas:</h3>
      <ul>
        <li v-for="(butaca, index) in butacasOcupadas" :key="index">
          Entrada {{ index + 1 }}: Fila {{ butaca.split('-')[0] }}, Asiento {{ butaca.split('-')[1] }}, Precio: {{ usePeliculaStore().precio }}€
        </li>
        <!-- Mostrar el total debajo de la última entrada -->
        <li v-if="butacasOcupadas.length > 0">
          Total: {{ calcularTotal() }}€
        </li>
        <l1>a21aledelfel@inspedralbes.cat</l1>
      </ul>
    </div>

    <div>
      <label for="email" class="email-label"></label>
      <input type="email" v-model="email" id="email" class="email-input" placeholder="Ingrese su correo electrónico">
    </div>
    <NuxtLink to="/">
      <button
        :class="{ 'buy-ticket-button': true, 'valid-email': validarEmail(email), 'invalid-email': !validarEmail(email) }"
        @click="finalizarCompra" :disabled="!validarEmail(email)">Finalizar compra</button>
    </NuxtLink>
  </div>
</template>
<script>
import { usePeliculaStore } from '~/stores/peliculaStore';

export default {
  data() {
    return {
      movie: {},
      email: ''
    };
  },
  computed: {
    butacasOcupadas() {
      const peliculaStore = usePeliculaStore();
      return peliculaStore.butacasOcupadas;
    },
  },
  created() {
    this.fetchMovieData();
  },
  methods: {
    fetchMovieData() {
      const peliculaStore = usePeliculaStore();
      const sesionID = peliculaStore.sesionID;
      const peliculas = peliculaStore.peliculas;

      if (sesionID !== null && sesionID >= 0 && sesionID < peliculas.length) {
        this.movie = peliculas[sesionID];
      } else {
        console.error('El sesionID no es un índice válido en el array de películas');
      }
    },
    validarEmail(email) {
      const re = /\S+@\S+\.\S+/;
      return re.test(email);
    },
    finalizarCompra() {
      if (!this.email) {
        alert('Por favor, ingrese su correo electrónico.');
        return;
      }

      const peliculaStore = usePeliculaStore();
      const peliculaActual = this.movie;

      if (!peliculaActual) {
        console.error('La película actual no está definida');
        return;
      }

      const precio = peliculaStore.precio;
      const butacasOcupadas = peliculaStore.butacasOcupadas;

      const asientos = butacasOcupadas.map(butaca => {
        const fila = butaca.split('-')[0];
        const asiento = butaca.split('-')[1];
        return {
          sesion_cine_id: peliculaStore.sesionID,
          Butaca: butaca,
          Fila: fila,
          Asiento: asiento,
          precio: precio,
          email: this.email
        };
      });

      const dataToSend = {
        email: this.email,
        asientos: asientos
      };

      console.log(dataToSend);

      fetch('http://tr3alex.daw.inspedralbes.cat/back/api/entradas', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataToSend)
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Error al finalizar la compra');
        }
        return response.json();
      })
      .then(data => {
        console.log('Entrada comprada exitosamente:', data);
        setTimeout(() => {
          // Realizar cualquier otra acción necesaria después de completar la compra
        }, 2000);
      })
      .catch(error => {
        console.error('Error al finalizar la compra:', error);
      });
    },
    calcularTotal() {
      const peliculaStore = usePeliculaStore();
      const total = peliculaStore.butacasOcupadas.reduce((acc, butaca) => {
        return acc + peliculaStore.precio;
      }, 0);
      return total;
    }
  }
};
</script>

<style scoped>
.cinema-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: auto 1fr;
  gap: 20px;
  background-color: black;
  padding: 20px;
  color: white;
}

.movie-poster-container {
  grid-column: 1;
}

.movie-poster {
  max-width: 200px;
}

h1,
h3 {
  margin: 0;
}

li {
  margin-bottom: 10px;

}

.purchase-info {
  grid-column: 2;
}

ul {
  list-style-type: none;
}

.buy-ticket-button {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.valid-email {
  background-color: rgba(0, 214, 170, .85);
  /* Color de fondo que coincide con el borde del email */
  color: white;
  /* Color del texto */
}
body {
    font-family: Helvetica, Arial, sans-serif;
  }
.invalid-email {
  background-color: red;
  /* Color de fondo rojo para correo electrónico no válido */
  color: white;
}

.buy-ticket-button:disabled {
  background-color: grey;
  /* Color de fondo gris para botón deshabilitado */
  cursor: not-allowed;
}

.email-label {
  color: rgba(0, 214, 170, .85);
  /* Color del borde */
}

.email-input {
  border: 3px solid rgba(0, 214, 170, .85);
  /* Borde con color rgba */
  border-radius: 5px;
  /* Esquinas redondeadas */
  padding: 5px 10px;
  /* Espaciado dentro del campo */
}
</style>
