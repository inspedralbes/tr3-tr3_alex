// stores/peliculaDestacadaStore.js

import { defineStore } from 'pinia'

export const usePeliculaDestacadaStore = defineStore('peliculaDestacada', {
  state: () => ({
    peliculaDestacada: null,
    butacasOcupadas: [] // Ahora almacenará la posición de las butacas ocupadas
  }),
  actions: {
    setPeliculaDestacada(pelicula) {
      this.peliculaDestacada = pelicula
    },
    actualizarButacasOcupadas(butacas) {
      this.butacasOcupadas = butacas;
    }
  }
})
