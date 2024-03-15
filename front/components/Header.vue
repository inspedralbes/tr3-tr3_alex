<template>

  <body>
    <header :class="{ 'header-visible': showHeader }">
      <h1 class="logo">Cine Alex</h1>
      <input type="checkbox" id="nav-toggle" class="nav-toggle">
      <nav>
        <ul>
          <li>
            <NuxtLink to="/">Inicio</NuxtLink>
          </li>
          <li>
            <NuxtLink to="/sesioActual">Sesio Actual</NuxtLink>
          </li>
          <li>
            <NuxtLink to="/proximamente">Proximament</NuxtLink>
          </li>
          <li>
            <NuxtLink to="/Contactanos">Contactanos</NuxtLink>
          </li>
        </ul>
      </nav>
      <label for="nav-toggle" class="nav-toggle-label">
        <span></span>
      </label>
    </header>
    <br>
  </body>
</template>

<script>
export default {
  name: 'Header',
  data() {
    return {
      showHeader: true,
      lastScrollTop: 0
    };
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
  destroyed() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    handleScroll() {
      const scrollTop = window.scrollY || window.pageYOffset || document.body.scrollTop + (document.documentElement && document.documentElement.scrollTop || 0);
      
      if (scrollTop > this.lastScrollTop) {
        // Si el usuario se desplaza hacia abajo, ocultamos el header
        this.showHeader = false;
      } else {
        // Si el usuario se desplaza hacia arriba, mostramos el header
        this.showHeader = true;
      }
      
      this.lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Work+Sans:300,600');

:root {
  --background: rgba(0, 214, 170, .85);
}

*,
*::before,
*::after {
  box-sizing: border-box;
}


.header-visible {
  background: rgba(0, 214, 170, .85);
  text-align: center;
  position: fixed;
  z-index: 999;
  width: 100%;
  top: 0;
  transition: top 0.3s;
  /* Animación de transición */
}

/* Estilo para el header cuando está oculto */
.header-hidden {
  top: -100px;
  /* Posición fuera de la vista */
  transition: top 0.3s;
  /* Animación de transición */
}

body {
  margin: 0;
  font-family: 'Work Sans', sans-serif;
  font-weight: 400;
}

header {
  background: rgba(0, 214, 170, .85);
  text-align: center;
  position: fixed;
  z-index: 999;
  width: 100%;
  top: 0;
  /* Asegura que el header comience desde arriba */
}

.container {
  margin-top: 80px;
  /* Agrega espacio entre el header y el contenido */
}

.nav-toggle {
  position: absolute;
  top: -9999px;
  left: -9999px;
}

body {
  margin: 0;
}

.nav-toggle:focus~.nav-toggle-label {
  outline: 3px solid rgba(lightblue, .75);
}

.nav-toggle-label {
  position: absolute;
  top: 0;
  left: 0;
  margin-left: 1em;
  height: 100%;
  display: flex;
  align-items: center;
}

.nav-toggle-label span,
.nav-toggle-label span::before,
.nav-toggle-label span::after {
  display: block;
  background: green;
  height: 2px;
  width: 2em;
  border-radius: 2px;
  position: relative;
}

.nav-toggle-label span::before,
.nav-toggle-label span::after {
  content: '';
  position: absolute;
}

.nav-toggle-label span::before {
  bottom: 7px;
}

.nav-toggle-label span::after {
  top: 7px;
}

nav {
  position: absolute;
  text-align: left;
  top: 100%;
  left: 0;
  background: rgba(0, 214, 170, .85);
  width: 100%;
  transform: scale(1, 0);
  transform-origin: top;
  transition: transform 400ms ease-in-out;
}

nav ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

nav li {
  margin-bottom: 1em;
  margin-left: 1em;
}

nav a {
  color: white;
  text-decoration: none;
  font-size: 1.2rem;
  text-transform: uppercase;
  opacity: 0;
  transition: opacity 150ms ease-in-out;
}

nav a:hover {
  color: #000;
}

.nav-toggle:checked~nav {
  transform: scale(1, 1);
}

.nav-toggle:checked~nav a {
  opacity: 1;
  transition: opacity 250ms ease-in-out 250ms;
}


@media screen and (min-width: 800px) {
  .nav-toggle-label {
    display: none;
  }

  header {
    display: grid;
    grid-template-columns: 1fr auto minmax(600px, 3fr) 1fr;
  }

  .logo {
    grid-column: 2 / 3;
  }

  nav {
    all: unset;
    /* this causes issues with Edge, since it's unsupported */

    /* the following lines are not from my video, but add Edge support */
    position: relative;
    text-align: left;
    transition: none;
    transform: scale(1, 1);
    background: none;
    top: initial;
    left: initial;
    /* end Edge support stuff */
    grid-column: 3 / 4;
    display: flex;
    justify-content: flex-end;
    align-items: center;
  }

  nav ul {
    display: flex;
  }

  nav li {
    margin-left: 3em;
    margin-bottom: 0;
  }

  nav a {
    opacity: 1;
    position: relative;
  }

  nav a::before {
    content: '';
    display: block;
    height: 5px;
    background: black;
    position: absolute;
    top: -.75em;
    left: 0;
    right: 0;
    transform: scale(0, 1);
    transition: transform ease-in-out 250ms;
  }

  nav a:hover::before {
    transform: scale(1, 1);
  }
}
</style>
./Header.vue