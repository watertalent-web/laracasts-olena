<script setup lang="ts">
defineProps<{
  /** Section title above the text */
  title?: string
}>()
</script>

<template>
  <UPageSection v-if="title" :title="title">
    <template #body>
      <UPageBody class="text-muted text-lg leading-relaxed">
        <slot />
      </UPageBody>
    </template>
  </UPageSection>
  <UContainer v-else>
    <UPageBody class="text-muted text-lg leading-relaxed">
      <slot />
    </UPageBody>
  </UContainer>
</template>
