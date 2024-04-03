<template>
  <div class="cinema-container" style="margin-top: 62px;">
    <h1>{{ movie.titulo }}</h1>
   
  </div>
</template>

<script>

import { usePeliculaDestacadaStore } from '~/stores/peliculaDestacadaStore'


export default {
  data() {
    return {
      selectedSeats: [],
         };
  },
  computed: {
  
    movie(){
      const peliculaDestacadaStore = usePeliculaDestacadaStore();
      return peliculaDestacadaStore.peliculaDestacada;
    }
  },
  setup() {

  },
  methods: {
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

.buy-ticket-button {
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.seat {
  width: 30px;
  height: 30px;
  margin: 5px;
  cursor: pointer;
  background-color: grey;
  display: flex;
  align-items: center;
  justify-content: center;
}

.seat.selected {
  background-color: green;
}

.seat span {
  color: white;
}

.hidden {
  display: none;
}

.purchase-info {
  color: white;
  margin-top: 20px;
}

h3 {
  color: white;
}
</style>
~/stores/peliculaStore