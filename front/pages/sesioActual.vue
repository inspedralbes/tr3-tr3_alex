<template>
  <div class="cinema-home" style="margin-top: 62px;">
    <h1>Sesión Actual</h1>
    <div class="sesion-list">
      <div v-if="sesionActual">
        <div class="movie-card">
          <h2>{{ sesionActual.pelicula.titulo }}</h2>
          <img :src="sesionActual.pelicula.poster" alt="Poster" />
          <p>Día: {{ sesionActual.fecha_hora }}</p>
          <!-- Añade cualquier otra información de la sesión que quieras mostrar -->
        </div>
      </div>
      <div v-else>
        <p>No hay sesión actual disponible.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sesionActual: null,
    };
  },
  async mounted() {
    await this.fetchSesionActual();
  },
  methods: {
    async fetchSesionActual() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/sessions');
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const sesiones = await response.json();
        const sesionesOrdenadas = sesiones.sort((a, b) => new Date(b.fecha_hora) - new Date(a.fecha_hora));
        const sesionActual = sesionesOrdenadas.find((sesion, index) => {
          if (index === 0) return true; // Si es la primera sesión, es la actual
          const fechaHoraActual = new Date();
          const fechaHoraSesion = new Date(sesion.fecha_hora);
          const fechaHoraSesionAnterior = new Date(sesionesOrdenadas[index - 1].fecha_hora);
          return fechaHoraActual >= fechaHoraSesion && fechaHoraActual < fechaHoraSesionAnterior;
        });
        if (sesionActual) {
          this.sesionActual = sesionActual;
        } else {
          console.log("No hay sesiones disponibles o ninguna sesión está en curso.");
        }
      } catch (error) {
        console.error("Could not fetch current session: ", error);
      }
    }
  }
};
</script>

<style scoped>
.cinema-home {
  max-width: 800px;
  margin: auto;
  padding: 20px;
  font-family: 'Arial', sans-serif;
}

.movie-card {
  border: 1px solid #ccc;
  padding: 15px;
  margin: 10px;
  border-radius: 8px;
  transition: transform 0.2s ease-in-out;
}

.movie-card:hover {
  transform: scale(1.05);
}
</style>
