<template>
  
    <div class="centro" style="margin-top: 62px;">
      <h2 class="page-title">Películas</h2>
    </div>
    <div class="peliculas-container">
      
       <div class="peliculas-grid">
        <div v-for="pelicula in peliculas" :key="pelicula.id" class="pelicula-card" @click="toggleAmpliada(pelicula)">
          <img :src="pelicula.poster" :alt="`Cartel de ${pelicula.titulo}`" class="pelicula-cartel">
          <div class="pelicula-info">
            <h2 class="pelicula-titulo">{{ pelicula.titulo }}</h2>
            <p class="pelicula-duracion">Duración: {{ convertirDuracion(pelicula.duracion) }}</p>
          </div>
        </div>
      </div> 
      <div v-if="peliculaAmpliada" class="pelicula-ampliada" style="margin-top: 0px;">
        <div class="pelicula-ampliada-contenido" style="margin-bottom: 20px;"> <!-- Añade un margen inferior -->
          <img :src="peliculaAmpliada.poster" :alt="`Cartel de ${peliculaAmpliada.titulo}`"
            class="pelicula-cartel-ampliada">
          <div class="pelicula-ampliada-info">
            <h2 class="pelicula-titulo">{{ peliculaAmpliada.titulo }}</h2>
            <p class="pelicula-duracion">Duración: {{ convertirDuracion(peliculaAmpliada.duracion) }}</p>
            <p class="pelicula-sinopsis">{{ peliculaAmpliada.sinopsis }}</p>
            <!-- Agrega el resto de la información que desees mostrar -->
          </div>
          <button @click="cerrarAmpliada" class="cerrar-ampliada">X</button>
        </div>
      </div>
    </div>
  
</template>


<script>
export default {
  data() {
    return {
      peliculas: [],
      peliculaAmpliada: null,
    };
  },
  async mounted() {
    await this.fetchPeliculas();
  },
  methods: {
    async fetchPeliculas() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/peliculas');
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        this.peliculas = data.data;
      } catch (error) {
        console.error("Could not fetch peliculas: ", error);
      }
    },
    convertirDuracion(minutos) {
      const horas = Math.floor(minutos / 60);
      const minutosRestantes = minutos % 60;
      return `${horas}h ${minutosRestantes}min`;
    },
    toggleAmpliada(pelicula) {
      if (this.peliculaAmpliada === pelicula) {
        this.peliculaAmpliada = null;
      } else {
        this.peliculaAmpliada = pelicula;
      }
    },
    cerrarAmpliada() {
      this.peliculaAmpliada = null;
    }
  }
};
</script>

<style scoped>
.page-title {
  font-size: 2rem;
  color: var(--color-primary);
  text-align: center;
  margin-bottom: 50px;
  margin: 0;
  /* Eliminar margen predeterminado */
  padding: 0;
}

body {
  background-color: black;
  /* Cambia el color de fondo de la página a negro */
}

.all{
   margin: 0; /* Eliminar margen predeterminado */
        width: 100%;
}

.peliculas-container {
  
  /* Hacer el contenedor más grande */
  background-color: black;
}

.peliculas-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  /* Mostrar 4 películas por fila */
  gap: 30px;



}

.page-title {
  color: white;
  background-color: black;
}

.pelicula-card {
  width: 300px;
  /* Ajustar el ancho de las tarjetas de película */
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
  margin-left: 40px;
  margin-bottom: 20px;
  cursor: pointer;
  /* Hacer que el cursor cambie a una mano al pasar sobre la tarjeta */
  background-color: white;
}

.pelicula-card:hover {
  transform: translateY(-5px);
}

.pelicula-cartel {
  width: 100%;
  height: 390px;
  /* Altura fija para los carteles */
  border-radius: 20px 20px 0 0;
  object-fit: cover;
  /* Ajusta la imagen dentro del contenedor sin distorsionarla */
}

.pelicula-ampliada {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  /* Fondo oscuro semitransparente */
  display: flex;
  justify-content: center;
  align-items: center;
}

.pelicula-ampliada-contenido {
  background-color: white;
  border-radius: 20px;
  padding: 20px;
  display: flex;
  max-width: 80%;
  max-height: 80%;
  overflow: auto;
}

.pelicula-cartel-ampliada {
  width: 300px;
  /* Ancho en píxeles */
  height: auto;
  border-radius: 20px;
  margin-right: 20px;
}

.cerrar-ampliada {
  align-self: flex-start;
  margin-bottom: 10px;
  cursor: pointer;
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #666;
}

.pelicula-ampliada-info {
  flex-grow: 1;
}

.pelicula-titulo {
  font-size: 1.6rem;
  font-weight: bold;
  color: #333;
  margin-bottom: 10px;
}

.pelicula-sinopsis {
  font-size: 1.2rem;
  color: #333;
  margin-bottom: 10px;
}

.pelicula-genero,
.pelicula-duracion {
  font-size: 1.2rem;
  color: #666;
  margin-bottom: 5px;
}
body {
    font-family: Helvetica, Arial, sans-serif;
  }

@media (max-width: 768px) {
  .peliculas-grid {
    grid-template-columns: repeat(1, 1fr);
    /* Cambia a 2 columnas en dispositivos más pequeños */
  }
}
</style>