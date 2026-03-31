<script setup lang="ts">
defineProps<{
  headline?: string
  title?: string
  description?: string
  links?: Record<string, unknown>[]
}>()
</script>

<template>
  <UPageHero v-bind="$attrs" :headline="headline" :title="title" :description="description" :links="links">
    <slot />
    <template v-if="$slots.headline" #headline>
      <slot name="headline" />
    </template>
    <template v-if="$slots.title" #title>
      <slot name="title" />
    </template>
    <template v-if="$slots.description" #description>
      <slot name="description" />
    </template>
    <template v-if="$slots.links" #links>
      <slot name="links" />
    </template>
  </UPageHero>
</template>
