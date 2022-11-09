<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Header from './components/includes/Header.vue'
import Footer from './components/includes/Footer.vue'
</script>

<template>
  <Header></Header>
  <main>
    <RouterView></RouterView>
  </main>
  <Footer></Footer>
</template>

<style scoped>

</style>
