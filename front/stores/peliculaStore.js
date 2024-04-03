// stores/peliculaStore.js
import { defineStore } from 'pinia'

export const usePeliculaStore = defineStore('pelicula', {
  state: () => ({
    peliculas: {}, // Objeto para almacenar películas por su ID
    butacasOcupadas: [] // Array para almacenar las butacas ocupadas
  }),
  actions: {
    // Método para actualizar o agregar una película por su ID
    actualizarPelicula(id, pelicula) {
      this.peliculas[id] = pelicula;
    },
    // Método para actualizar las butacas ocupadas
    actualizarButacasOcupadas(butacas) {
      this.butacasOcupadas = butacas;
    },
    // Método para guardar la sesión de compra
    setSesionID(sesionId) {
      this.sesionID = sesionId;
    }
  }
})
