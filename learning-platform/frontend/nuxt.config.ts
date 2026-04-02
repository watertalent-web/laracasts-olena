// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@nuxt/ui', '@storyblok/nuxt'],
  css: ['~/assets/css/main.css'],
  storyblok: {
    accessToken: 'o9GA2VSQQYbKxmedp0sAOwtt',
  },
})
