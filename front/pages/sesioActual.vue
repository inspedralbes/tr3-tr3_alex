<template>
  <div style="margin-top: 62px;">
    <h1>Acerca de Nosotros</h1>
    <div v-for="pelicula in peliculas" :key="pelicula.id">
      <h2>{{ pelicula.titulo }}</h2>
      <p>{{ pelicula.sinopsis }}</p>
      <!-- Agrega más detalles de la película según sea necesario -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      peliculas: []
    };
  },
  created() {
    this.fetchPeliculas();
  },
  methods: {
    async fetchPeliculas() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/peliculas');
        if (!response.ok) {
          throw new Error('Error al obtener las películas');
        }
        const data = await response.json();
        this.peliculas = data;
      } catch (error) {
        console.error('Error al obtener las películas:', error);
      }
    }
  }
};
</script>
