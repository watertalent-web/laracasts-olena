<script setup>
defineProps({ blok: Object })
</script>

<template>
  <div class="mb-8">

    <h2 v-if="blok.title" class="text-xl font-bold mb-4">
      {{ blok.title }}
    </h2>

    <div v-for="nested in blok.body || []" :key="nested._uid">
      <component :is="nested.component" :blok="nested" />
    </div>

  </div>
</template>