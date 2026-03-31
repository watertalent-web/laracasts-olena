<script setup lang="ts">
defineProps<{
  title?: string
  description?: string
  links?: Record<string, unknown>[]
  variant?: string
}>()
</script>

<template>
  <UPageCTA v-bind="$attrs" :title="title" :description="description" :links="links" :variant="variant">
    <template v-if="$slots.title" #title>
      <slot name="title" />
    </template>
    <template v-if="$slots.description" #description>
      <slot name="description" />
    </template>
    <template v-if="$slots.links" #links>
      <slot name="links" />
    </template>
  </UPageCTA>
</template>
