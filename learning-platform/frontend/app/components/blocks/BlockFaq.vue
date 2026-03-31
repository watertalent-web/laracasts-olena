<script setup lang="ts">
defineProps<{
  headline?: string
  title?: string
  description?: string
  items?: { label: string; content?: string; icon?: string }[]
}>()
</script>

<template>
  <UPageSection :headline="headline" :title="title" :description="description">
    <UAccordion v-if="items?.length" :items="items" />
    <slot v-else />
  </UPageSection>
</template>
