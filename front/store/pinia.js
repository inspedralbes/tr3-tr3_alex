import { createPinia } from '@pinia/nuxt'

export default ({ app }) => {
  const pinia = createPinia()
  app.use(pinia)
}