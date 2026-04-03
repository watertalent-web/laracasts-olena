<script setup lang="ts">
const props = defineProps<{
  blok: {
    _uid?: string
    text?: string
  }
}>()

/** Storyblok textarea often has plain text; richtext may ship simple HTML tags */
const looksLikeHtml = computed(() => {
  const t = props.blok?.text?.trim()
  if (!t) return false
  return /^<[\s\S]+>/.test(t)
})
</script>

<template>
  <div class="lesson-text max-w-3xl mx-auto py-3 first:pt-0 last:pb-0 mb-8">
    <div
      v-if="looksLikeHtml"
      class="text-muted text-lg leading-relaxed [&_a]:text-primary [&_a]:underline [&_a]:underline-offset-2 [&_p+p]:mt-4 [&_ul]:list-disc [&_ul]:pl-6 [&_ul]:my-3 [&_ol]:list-decimal [&_ol]:pl-6 [&_ol]:my-3 [&_strong]:text-highlighted [&_strong]:font-semibold"
      v-html="blok.text"
    />
    <p
      v-else
      class="text-muted text-lg leading-relaxed whitespace-pre-wrap"
    >
      {{ blok.text }}
    </p>
  </div>
</template>