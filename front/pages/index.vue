  <template>
    <div class="container">
      <!-- Película de esta semana -->
      <!-- <section>
        <h2>Película de esta Semana</h2>
        <div v-if="sesion in sesiones" :key="sesion.id" class="movie-of-the-week">
          <img :src="peliculaDestacada.poster" :alt="peliculaDestacada.titulo" class="movie-poster-large">
          <div class="movie-details">
            <h3>{{ peliculaDestacada.titulo }}</h3>
            <p><strong>Duración:</strong> {{ peliculaDestacada.duracion }}</p>
            <p><strong>Sinopsis:</strong> {{ peliculaDestacada.sinopsis }}</p>
            <button class="buy-ticket-button" @click="goToCinemaRoom()">Comprar Entradas</button>
          </div>
        </div>
      </section> -->

      <!-- Próximamente -->
      <section>
        <h2>Próximamente</h2>
        <div class="upcoming-movies">
          <div v-for="sesion in sesiones" :key="sesion.id" class="movie">
            <img :src="sesion.pelicula.poster" :alt="sesion.pelicula.titulo" class="movie-poster-small">
            <h3>{{ sesion.pelicula.titulo }}</h3>
          </div>
          <div v-if="sesiones.length < 3" class="movie"></div>
        </div>
      </section>
    </div>
  </template>

  <script>

  import { usePeliculaDestacadaStore } from '~/stores/peliculaDestacadaStore'


  export default {
    setup() {
      const peliculaDestacadaStore = usePeliculaDestacadaStore()
      
    },

    data(){
      return {
        sesiones: []
      }
    },
    mounted() {
      this.fetchSesiones();
    },
    methods: {

      fetchSesiones() {
        fetch('http://localhost:8000/api/sesiones')
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            this.sesiones = data;
          })
          .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
          });
      },
      reservarEntrada(sesionId) {
        const store = useSesionCompraStore(); // Obtén la instancia de Pinia
        store.setSesionID(sesionId); // Guardar el ID de la sesión seleccionada en Pinia
      },

      goToCinemaRoom() {
        this.$router.push('/salaCine')
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
  }

  .movie-of-the-week .movie-poster-large {
    width: 100%;
    /* Utiliza todo el ancho disponible */
    height: auto;
    max-width: 400px;
    /* Limita el ancho máximo */
    margin-right: 20px;
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

  @media screen and (max-width: 768px) {

    /* Estilos específicos para pantallas con un ancho máximo de 768px (tamaño móvil) */
    .container {
      margin-top: 200px;
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
