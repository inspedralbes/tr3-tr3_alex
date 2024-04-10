<template>
  <div class="container">
    <section>

      <div class="container">
        <!-- Mostrar la película más reciente -->
        <div v-if="peliculaMasReciente" class="movie-of-the-week upcoming-movies">
          <img :src="peliculaMasReciente.pelicula.poster" :alt="peliculaMasReciente.pelicula.titulo"
            class="movie-poster-large">
          <div class="movie-details">
            <h4>{{ peliculaMasReciente.pelicula.titulo }}</h4>
            <c3>{{ peliculaMasReciente.pelicula.sinopsis }}</c3>
            <p>Fecha de estreno: {{ formatFecha(peliculaMasReciente.fecha_hora) }}</p>
            <nuxt-link :to="'/' + peliculaMasReciente.id" class="buy-ticket-button" @click="guardarPeliculaSeleccionada(peliculaMasReciente.id)">Reservar entrada</nuxt-link>
          </div>
        </div>
      </div>

      <h2>Próximamente</h2>

      <!-- Listado de películas -->
      <div class="upcoming-movies">
        <div v-for="(sesion, index) in sesiones" :key="sesion.id" class="movie" v-if="index !== 0">
          <img :src="sesion.pelicula.poster" :alt="sesion.pelicula.titulo" class="movie-poster-small">
          <h3>{{ sesion.pelicula.titulo }}</h3>
          <p>Fecha de estreno: {{ formatFecha(sesion.fecha_hora) }}</p>
          <nuxt-link :to="'/' + sesion.id" class="buy-ticket-button" @click="guardarPeliculaSeleccionada(sesion.id)">Reservar entrada</nuxt-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { usePeliculaStore } from '~/stores/peliculaStore'

export default {
  data() {
    return {
      sesiones: [],
      peliculaMasReciente: null
    }
  },
  created() {
    this.fetchSesiones(); // Llamar al método fetchSesiones al cargar la página
  },
  methods: {
    fetchSesiones() {
      const peliculaStore = usePeliculaStore();

      fetch('http://localhost:8000/api/sesiones')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          // Ordenar las sesiones por la fecha de estreno
          this.sesiones = data.sort((a, b) => new Date(a.fecha_hora) - new Date(b.fecha_hora));

          // Asignar la primera sesión como la película más reciente
          this.peliculaMasReciente = this.sesiones.length > 0 ? this.sesiones[0] : null;

          // Guardar la película más reciente en la tienda de películas
          if (this.peliculaMasReciente) {
            peliculaStore.actualizarPelicula(this.peliculaMasReciente.id, this.peliculaMasReciente.pelicula);
          }

          // Eliminar la primera sesión de la lista de sesiones
          this.sesiones = this.sesiones.slice(1);

          // Guardar información de todas las películas en la tienda de películas
          this.sesiones.forEach(sesion => {
            peliculaStore.actualizarPelicula(sesion.id, sesion.pelicula);
          });
        })
        .catch(error => {
          console.error('There has been a problem with your fetch operation:', error);
        });
    },
    formatFecha(fecha) {
      return new Date(fecha).toLocaleDateString();
    },
    guardarPeliculaSeleccionada(id) {
      const peliculaStore = usePeliculaStore();
      peliculaStore.setSesionID(id);
      console.log('ID de la película seleccionada:', id);
    }
  }
}
</script>

<style scoped>
.container {
  background-color: #000;
  color: #fff;
  padding-left: 10%;
  /* Agregamos padding en lugar de margen izquierdo */
  padding-right: 10%;
  margin-top: 62px;
}

h1,
h2,
h3,
p {
  color: #fff;
}

h4 {
  font-size: 150%;
}

section {
  margin-top: 20px;
}

h2 {
  margin-bottom: 15px;
}

.movie-of-the-week {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  margin-top: 20px;
}

.movie-of-the-week .movie-poster-large {
  width: 100%;
  /* Utiliza todo el ancho disponible */
  height: auto;
  max-width: 400px;
  /* Limita el ancho máximo */
  margin-right: 20px;
  margin-top: 40px;
}

.movie-details {
  flex: 1;
}

.upcoming-movies {
  display: flex;
  flex-wrap: wrap;
  /* Permite que los elementos se envuelvan en una nueva línea */
  gap: 20px;
  /* Espacio entre las películas */
}

.movie {
  width: calc(25% - 10px);
  /* 25% del ancho del contenedor, menos el espacio entre las películas */
  margin-bottom: 20px;
  margin-right: 50px;
}

.movie h3 {
  margin-top: 10px;
}

.movie-poster-small {
  width: 100%;
  /* Utiliza todo el ancho disponible */
  height: auto;
  max-width: 300px;
  /* Limita el ancho máximo */
}

body {
  margin: 0%;
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

.buy-ticket-button:hover {
  background-color: #0056b3;
}

a:-webkit-any-link {

  cursor: pointer;
  text-decoration: none;
}

@media screen and (max-width: 768px) {

  /* Estilos específicos para pantallas con un ancho máximo de 768px (tamaño móvil) */
  .container {
    margin-top: 62px;
    /* Cambia el margen superior para la versión móvil */
  }

  .upcoming-movies {
    justify-content: center;
    /* Centra las películas en pantallas pequeñas */
  }

  .movie {
    width: calc(50% - 10px);
    /* Muestra dos películas por fila en dispositivos pequeños */
  }
}
</style>
