<template>
  <div class="container">
    <h1>Cine Estelar</h1>
    
    <!-- Carrusel de imágenes -->
    <div class="swiper-container">
      <swiper :options="swiperOptions">
        <swiper-slide v-for="imagen in imagenesCarrusel" :key="imagen">
          <img :src="imagen" alt="Imagen de película">
        </swiper-slide>
        <div class="swiper-pagination"></div>
      </swiper>
    </div>
    
    <!-- Películas de esta semana -->
    <section>
      <h2>Película de esta Semana</h2>
      <div v-for="pelicula in peliculasDestacadas" :key="pelicula.id">
        <h3>{{ pelicula.titulo }}</h3>
        <p>{{ pelicula.descripcion }}</p>
      </div>
    </section>
    
    <!-- Próximamente -->
    <section>
      <h2>Próximamente</h2>
      <!-- Contenido similar al anterior con las películas próximas -->
    </section>
  </div>
</template>

<script>
// Importa Swiper y Swiper styles
import { Swiper, SwiperSlide } from 'swiper/vue';
import SwiperCore, { Pagination, Navigation } from 'swiper/core';
import 'swiper/swiper-bundle.css';

// Instala los módulos de Swiper
SwiperCore.use([Pagination, Navigation]);

export default {
  components: {
    Swiper,
    SwiperSlide
  },
  data() {
    return {
      swiperOptions: {
        loop: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        // Añade más opciones según necesites
      },
      imagenesCarrusel: [
        '/path/to/image-1.jpg',
        '/path/to/image-2.jpg',
        // Más imágenes aquí
      ],
      peliculasDestacadas: [
        { id: 1, titulo: "Pelicula A", descripcion: "Descripción de Pelicula A" },
        // Solo una película si se emite una a la vez
      ],
      // Añadir otro array para próximamente si es necesario
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

.swiper-container {
  width: 100%;
  height: 400px;
}

.swiper-slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

section {
  margin-top: 20px;
}

h2 {
  margin-bottom: 15px;
}
</style>
