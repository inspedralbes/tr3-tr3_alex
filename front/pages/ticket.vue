<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <h1>{{ movie.titulo }}</h1>
    <img :src="movie.poster" :alt="movie.titulo" class="movie-poster">
    <p>Fecha de estreno: {{ movie.fecha }}</p>
    <div class="purchase-info">
      <h3>Butacas Seleccionadas:</h3>
      <ul>
        <li v-for="(butaca, index) in butacasOcupadas" :key="index">
          Entrada {{ index + 1 }}: Fila {{ butaca.split('-')[0] }}, Asiento {{ butaca.split('-')[1] }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { usePeliculaStore } from '~/stores/peliculaStore'

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
      this.movie = peliculaStore.peliculas[sesionID];
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
  background-color: black;
  padding: 20px;
  display: flex;
  flex-direction: column;
}

.movie-poster {
  max-width: 200px;
}

h1, p, h3, li {
  color: white;
}

.purchase-info {
  margin-top: 20px;
}

ul {
  list-style-type: none;
}
</style>
