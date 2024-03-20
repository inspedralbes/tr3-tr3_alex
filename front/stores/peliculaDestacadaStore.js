// stores/peliculaDestacadaStore.js

import { defineStore } from 'pinia'

export const usePeliculaDestacadaStore = defineStore('peliculaDestacada', {
  state: () => ({
    peliculaDestacada: null
  }),
  actions: {
    setPeliculaDestacada(pelicula) {
      this.peliculaDestacada = pelicula
    }
  }
})
