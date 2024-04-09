import { defineStore } from 'pinia'

export const usePeliculaStore = defineStore('pelicula', () =>{
  const peliculas = ref([]);
  const butacasOcupadas = ref([]);
  const sesionID = ref(0);
  

  function actualizarPelicula(id, pelicula) {
    peliculas.value[id] = pelicula;
  }

  function actualizarButacasOcupadas(butacas) {
    butacasOcupadas.value = butacas;
  }

  function setSesionID(sesionId) {
    sesionID.value = sesionId;
  }


  return {
    peliculas,
    butacasOcupadas,
    sesionID,
    actualizarPelicula,
    actualizarButacasOcupadas,
    setSesionID

  
}


});
