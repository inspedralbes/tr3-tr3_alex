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


// {
//   state: () => ({
//     peliculas: {}, // Objeto para almacenar películas por su ID
//     butacasOcupadas: [], // Array para almacenar las butacas ocupadas
//     sesionID:  // ID de la sesión de compra
//   }),
//   actions: {
//     // Método para actualizar o agregar una película por su ID
//     actualizarPelicula(id, pelicula) {
//       this.peliculas[id] = pelicula;
//     },
//     // Método para actualizar las butacas ocupadas
//     actualizarButacasOcupadas(butacas) {
//       this.butacasOcupadas = butacas;
//     },
//     // Método para guardar la sesión de compra
//     setSesionID(sesionId) {
//       this.sesionID = sesionId;
//     }
//   }
// }
});
