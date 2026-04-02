<script setup lang="ts">
const props = defineProps<{
  blok: {
    _uid?: string
    url?: string
    title?: string
    caption?: string
  }
}>()

function youtubeIdFromUrl(raw: string): string | null {
  const url = raw?.trim()
  if (!url) return null

  try {
    const u = new URL(url.startsWith('http') ? url : `https://${url}`)

    if (u.hostname.replace('www.', '') === 'youtu.be') {
      const id = u.pathname.replace(/^\//, '').split('/')[0]
      return id || null
    }

    if (u.pathname.includes('/embed/')) {
      const parts = u.pathname.split('/embed/')
      return parts[1]?.split('/')[0] || null
    }

    if (u.pathname.includes('/shorts/')) {
      const parts = u.pathname.split('/shorts/')
      return parts[1]?.split('/')[0] || null
    }

    const v = u.searchParams.get('v')
    if (v) return v
  } catch {
    const m = url.match(/(?:v=|youtu\.be\/|embed\/|shorts\/)([a-zA-Z0-9_-]{11})/)
    return m?.[1] ?? null
  }

  return null
}

const videoId = computed(() => youtubeIdFromUrl(props.blok?.url ?? ''))

const embedUrl = computed(() =>
  videoId.value ? `https://www.youtube.com/embed/${videoId.value}` : ''
)
</script>

<template>
  <figure class="lesson-video max-w-4xl mx-auto py-4 first:pt-0 last:pb-0">
    <div
      v-if="embedUrl"
      class="relative overflow-hidden rounded-xl ring ring-default shadow-sm bg-elevated aspect-video"
    >
      <iframe
        class="absolute inset-0 h-full w-full"
        :src="embedUrl"
        :title="blok.title || 'Video'"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen
        loading="lazy"
      />
    </div>

    <UCard
      v-else
      class="ring-default"
    >
      <p class="text-muted text-sm">
        Add a valid YouTube URL (watch, youtu.be, or embed).
      </p>
      <p
        v-if="blok.url"
        class="text-dimmed text-xs mt-2 font-mono truncate"
      >
        {{ blok.url }}
      </p>
    </UCard>

    <figcaption
      v-if="blok.caption || blok.title"
      class="mt-3 text-center text-sm text-dimmed"
    >
      {{ blok.caption || blok.title }}
    </figcaption>
  </figure>
</template>
