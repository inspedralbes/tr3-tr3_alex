<template>
  <footer class="footer" v-show="showFooter">
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
  },
  destroyed() {
    window.removeEventListener('scroll', this.handleScroll);
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
    }
  }
}
</script>

<style scoped>
.footer {
  background-color: #f0f0f0;
  padding: 20px;
  text-align: center;
  position: fixed;
  bottom: 0;
  width: 100%;
}
</style>
