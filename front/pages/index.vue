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

      fetch('http://procinealex.daw.inspedralbes.cat/back/public/api/sesiones')
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
  height: auto;
  max-width: 400px;
  margin-right: 20px;
  margin-top: 40px;
}

.movie-details {
  flex: 1;
}

.upcoming-movies {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.movie {
  width: calc(25% - 10px);
  margin-bottom: 20px;
  margin-right: 50px;
}

.movie h3 {
  margin-top: 10px;
}

.movie-poster-small {
  width: 100%;
  height: auto;
  max-width: 300px;
}

.buy-ticket-button {
  margin-top: 20px;
  padding: 10px 20px;
  background-color: rgba(0, 214, 170, .85); /* Cambia el color del botón */
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

body {
  font-family: Helvetica, Arial, sans-serif;
}
@media screen and (max-width: 768px) {
  .container {
    margin-top: 62px;
  }

  .upcoming-movies {
    justify-content: center;
  }

  .movie {
    width: calc(50% - 10px);
  }

  .buy-ticket-button {
    /* Ajusta el tamaño del botón en dispositivos móviles */
    padding: 8px 16px;
    font-size: 14px;
  }
}
</style>
