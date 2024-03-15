<template>
  <body>
  <div class="container" style="margin-top: 62px;">     
    <!-- Película de esta semana -->
    <section>
      <h2>Película de esta Semana</h2>
      <div class="movie-of-the-week">
        <img :src="peliculasDestacadas[0].poster" :alt="peliculasDestacadas[0].titulo" class="movie-poster">
        <div class="movie-details">
          <h3>{{ peliculasDestacadas[0].titulo }}</h3>
          <p><strong>Duración:</strong> {{ peliculasDestacadas[0].duracion }}</p>
          <p><strong>Sinopsis:</strong> {{ peliculasDestacadas[0].sinopsis }}</p>
          <button class="buy-ticket-button" @click="goToCinemaRoom">Comprar Entradas</button>
        </div>
      </div>
    </section>
    
    <!-- Próximamente -->
    <section>
      <h2>Próximamente</h2>
      <div class="upcoming-movies">
        <div class="movie" v-for="pelicula in peliculasProximas" :key="pelicula.id">
          <img :src="pelicula.poster" :alt="pelicula.titulo" class="movie-poster">
          <h3>{{ pelicula.titulo }}</h3>
        </div>
      </div>
    </section>
  </div>
  </body>
</template>

<script>
export default {
  methods: {
    goToCinemaRoom() {
      this.$router.push('/salaCine');
    },
  },
  data() {
    return {
      peliculasDestacadas: [
        { 
          id: 1, 
          titulo: "King Kong", 
          descripcion: "Descripción de Pelicula A", 
          poster: "./Kingkong.jpg", 
          duracion: "187 min", 
          sinopsis: "Durante la Gran Depresión, Ann Darrow (Naomi Watts), una actriz de vodevil, se queda sin trabajo. Su suerte parece cambiar cuando conoce a Carl Denham (Jack Black), un empresario que lucha para abrirse camino en el mundo del espectáculo. A ellos se une Jack Driscoll (Adrien Brody), un autor de teatro. Los tres emprenden un viaje a una remota isla, donde Denham tiene previsto dirigir una película. En una frondosa selva, descubren a King Kong, un gorila gigantesco, y a una tribu de seres prehistóricos que han vivido ocultos durante millones de años. Movido por su insaciable ambición, Denham, planea la captura del gorila con el propósito de exhibirlo en Nueva York. " 
        },
        // Solo una película si se emite una a la vez
      ],
      peliculasProximas: [
        { id: 2, titulo: "Pelicula B", poster: "./Kingkong.jpg" },
        { id: 3, titulo: "Pelicula C", poster: "./Kingkong.jpg" },
        { id: 4, titulo: "Pelicula D", poster: "./Kingkong.jpg" },
      ],
    };
  },
};
</script>

<style scoped>
.container {
  background-color: #000;
  color: #fff;
}

h1, h2, h3, p {
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

.movie-of-the-week .movie-poster {
  width: 200px;
  height: auto;
  margin-right: 20px;
}

.movie-details {
  flex: 1;
}

.upcoming-movies {
  display: flex;
  justify-content: space-between;
}

.movie {
  width: calc(33% - 10px); /* 33% del ancho del contenedor, menos el espacio entre las películas */
}

.movie h3 {
  margin-top: 10px;
}

.movie-poster {
  width: 100%;
  height: auto;
}

body{
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
    margin-top: 200px; /* Cam bia el margen superior para la versión móvil */
  }
}


</style>
