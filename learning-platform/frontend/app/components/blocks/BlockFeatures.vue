<script setup lang="ts">
defineProps<{
  headline?: string
  title?: string
  description?: string
  features?: {
    icon?: string
    title?: string
    description?: string
    to?: string
  }[]
}>()
</script>

<template>
  <UPageSection v-bind="$attrs" :headline="headline" :title="title" :description="description" :features="features">
    <template v-if="$slots.features" #features>
      <slot name="features" />
    </template>
    <template v-if="$slots.body" #body>
      <slot name="body" />
    </template>
  </UPageSection>
</template>
