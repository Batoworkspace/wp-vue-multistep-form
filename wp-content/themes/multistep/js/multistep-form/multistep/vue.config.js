module.exports = {
  transpileDependencies: ['vuetify'],
  css: {
    loaderOptions: {
      scss: {
        additionalData: `@import "@/assets/index.scss";`
      }
    }
  }
}
