<template>
  <footer>
    <div class="footer-container">
      <div class="footer-item">
        <h3>Cine Alex</h3>
        <p>Descubre la emoción del cine en Cines Alex, donde las últimas películas cobran vida. Abiertos todos los días,
          ofrecemos una experiencia única con proyecciones modernas y deliciosas golosinas.</p>
      </div>
      <div class="footer-item">
        <h3>Páginas</h3>
        <ul>
          <li>
            <nuxt-link to="/" class="footer-link">Inicio</nuxt-link>
          </li>
          <br>
          <!-- <li>
            <nuxt-link to="/sesioActual" class="footer-link">Sesio Actual</nuxt-link>
          </li>
          <br> -->
          <li>
            <nuxt-link to="/peliculas" class="footer-link">Peliculas</nuxt-link>
          </li>
          <br>
          <li>
            <nuxt-link to="/Contactanos" class="footer-link">Contactanos</nuxt-link>
          </li>
        </ul>
      </div>
      <div class="footer-item">
        <h3>Contactanos</h3>
        <p>Teléfono: 123-456-7890</p>
        <p>Correo: info@cinealex.com</p>
        <img src="/logo.png" alt="Contacto" width="100">
      </div>
      <div class="footer-item">
        <h3>Mapa</h3>
        <p>Av. d'Esplugues, 40, Les Corts, 08034 Barcelona</p>
        <!-- Aquí podrías insertar un iframe de Google Maps si lo prefieres -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2993.428020491708!2d2.106331!3d41.3865102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a49854a99cad2f%3A0xb564263b0575d513!2sInstituto%20Pedralbes!5e0!3m2!1ses!2ses!4v1710838336272!5m2!1ses!2ses" width="250" height="175" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  /* 4 columnas de igual ancho */
}

footer {
  padding-left: 20px; /* Padding a la izquierda */
  padding-right: 20px; /* Padding a la derecha */
  background-color: #000;
  padding-bottom: 20px; /* Padding abajo */
}

.footer-item {
  background-color: #000;
  /* Color de fondo en negro */
  padding: 10px;
  /* Espaciado interno de los elementos */
  box-sizing: border-box;
  /* El espaciado interno se incluirá en el ancho total */
  color: #fff;
  /* Color del texto en blanco */
}

.footer-item h3 {
  margin-top: 0;
  /* Elimina el margen superior del título */
}

.footer-item ul {
  padding: 0;
  /* Elimina el espaciado interior de la lista */
}

.footer-item ul li {
  list-style: none;
  /* Elimina los marcadores de lista */
}

/* Estilos para los enlaces */
.footer-link {
  color: #fff; /* Color del texto */
  text-decoration: none; /* Quita el subrayado */
}

/* Media Query para dispositivos con un ancho máximo de 768px (pantallas pequeñas) */
@media (max-width: 768px) {
  .footer-container {
    grid-template-columns: repeat(1, 1fr);
    /* Cambiar a una columna en pantallas pequeñas */
  }
}
</style>