<template>
  <div class="main">
    <!-- Contenido principal de tu página -->
    <!-- ... -->
  </div>
  <footer class="footer" :class="{ 'footer-hidden': !showFooter }">
    <p>&copy; 2024 Mi Compañía</p>
  </footer>
</template>

<script>
export default {
  name: 'FooterComponent',
  data() {
    return {
      showFooter: false
    };
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
    window.addEventListener('resize', this.handleResize);
    this.handleScroll(); // Llama a handleScroll cuando se monta el componente para verificar el estado inicial
  },
  destroyed() {
    window.removeEventListener('scroll', this.handleScroll);
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    handleScroll() {
      const windowHeight = window.innerHeight;
      const documentHeight = document.documentElement.scrollHeight;
      const scrollTop = window.scrollY || window.pageYOffset || document.body.scrollTop + (document.documentElement && document.documentElement.scrollTop || 0);

      // Si el desplazamiento más la altura de la ventana es igual a la altura total del documento, mostramos el footer
      if (windowHeight + scrollTop >= documentHeight) {
        this.showFooter = true;
      } else {
        this.showFooter = false;
      }
    },
    handleResize() {
      // Llama a handleScroll cuando cambia el tamaño de la ventana para actualizar el estado del footer
      this.handleScroll();
    }
  }
}
</script>

<style scoped>
.main {
  margin-bottom: 90px; /* Ajusta el margen inferior para evitar que el contenido se superponga con el footer */
}

.footer {
  background-color: #f0f0f0;
  padding: 20px;
  text-align: center;
  position: fixed;
  bottom: 0;
  width: 100%;
  transition: transform 0.3s; /* Agrega una transición suave */
}

.footer-hidden {
  transform: translateY(100%); /* Oculta el footer fuera de la pantalla */
}
</style>
