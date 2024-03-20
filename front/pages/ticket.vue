<template>
    <div>
      <h1>Confirmación de compra</h1>
      <h2>Película: {{ movie }}</h2>
      <h3>Butacas seleccionadas:</h3>
      <ul>
        <li v-for="(seat, index) in selectedSeats" :key="index">
          Butaca {{ seat }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import { useCinemaStore } from '~/stores/peliculaDestacadaStore.js';
  
  export default {
    computed: {
      selectedSeats() {
        return useCinemaStore().selectedSeats;
      },
      movie() {
        // Aquí obtén la información de la película, por ejemplo, desde una tienda Vuex o desde una API
        return 'Nombre de la película';
      },
    },
  };
  </script>
  