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
          Entrada {{ index + 1 }}: Fila {{ butaca.split('-')[0] }}, Asiento {{ butaca.split('-')[1] }}
        </li>
      </ul>
    </div>
    <button class="buy-ticket-button" @click="finalizarCompra">Finalizar compra</button>
  </div>
</template>

<script>
import { usePeliculaStore } from '~/stores/peliculaStore';

export default {
  data() {
    return {
      movie: {}
    };
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
    finalizarCompra() {
      const peliculaStore = usePeliculaStore();
      const peliculaActual = this.movie;

      if (!peliculaActual) {
        console.error('La película actual no está definida');
        return;
      }

      const dataToSend = {
        sesion_id: peliculaStore.sesionID,
        asientos: peliculaStore.butacasOcupadas.map((butaca, index) => {
          const fila = butaca.split('-')[0];
          const asiento = butaca.split('-')[1];
          return {
            sesion_cine_id: peliculaStore.sesionID,
            Butaca: peliculaStore.butacasOcupadas[index],
            Fila: fila,
            Asiento: asiento
          };
        }),
        
      };

      console.log(dataToSend);

      fetch('http://localhost:8000/api/entradas', {
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
    }



  },
  computed: {
    butacasOcupadas() {
      const peliculaStore = usePeliculaStore();
      return peliculaStore.butacasOcupadas;
    }
  },
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
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>
