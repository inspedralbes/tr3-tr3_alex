import { defineStore } from 'pinia';

export const usePeliculaStore = defineStore('pelicula', () => {
  const peliculas = ref([]);
  const butacasOcupadas = ref([]);
  const sesionID = ref(0);
  const precio = ref(0.0); // Definimos precio como un ref de tipo Number

  function actualizarPelicula(id, pelicula) {
    peliculas.value[id] = pelicula;
  }

  function actualizarButacasOcupadas(butacas) {
    butacasOcupadas.value = butacas;
  }

  function setSesionID(sesionId) {
    sesionID.value = sesionId;
  }

  function actualizarPrecio(nuevoPrecio) {
    precio.value = nuevoPrecio;
  }

  return {
    peliculas,
    butacasOcupadas,
    sesionID,
    precio,
    actualizarPelicula,
    actualizarButacasOcupadas,
    setSesionID,
    actualizarPrecio,
  }
});
