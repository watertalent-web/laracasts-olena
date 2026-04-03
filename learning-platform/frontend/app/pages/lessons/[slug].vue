<script setup lang="ts">
const route = useRoute()

// Storyblok API
const storyblokApi = useStoryblokApi()

// Get lesson data
const { data } = await storyblokApi.get(`cdn/stories/lessons/${route.params.slug}`, {
  version: 'draft'
})

const story = computed(() => data.story)

// Get lesson description
const description = computed(() => {
  const c = story.value?.content as Record<string, unknown> | undefined
  if (!c) return undefined
  const d = c.description ?? c.teaser ?? c.intro
  return typeof d === 'string' ? d : undefined
})

// Get author data
const authorUuid = story.value.content.author
const { data: authorData } = authorUuid
  ? await storyblokApi.get('cdn/stories', { version: 'draft', by_uuids: authorUuid })
  : { data: null }

const author = authorData?.stories?.[0] ?? null

const authorAvatarSrc = author.content.avatar.filename

</script>

<template>
  <UContainer class="py-8 md:py-12 max-w-5xl">
    <div class="mb-10 md:mb-12">
      <UPageHeader :title="story.name" :description="description" :links="[
        {
          label: 'All lessons',
          to: '/lessons',
          color: 'neutral',
          variant: 'subtle',
          icon: 'i-lucide-arrow-left'
        }
      ]" />
      <UBadge v-for="lvl in data.story.content.level" :key="lvl" class="mt-4 mr-2">
        {{ lvl }}
      </UBadge>

      <div v-if="author" class="mt-5 flex items-center gap-3 text-sm text-muted">
        <UAvatar :src="authorAvatarSrc" :alt="author.name" size="sm" />
        <span>
          By <span class="font-medium text-default">{{ author.name }}</span>
        </span>
      </div>
    </div>

    <div v-if="(story.content?.body?.length ?? 0) > 0" class="space-y-2 md:space-y-4">
      <div v-for="blok in story.content?.body ?? []" :key="blok._uid"
        class="rounded-xl border border-default bg-elevated/30 p-4 md:p-8 transition-colors hover:bg-elevated/50">
        <component :is="blok.component" :blok="blok" />
      </div>
    </div>

    <UCard v-else class="mt-6">
      <p class="text-muted">
        Lesson content has not been added in Storyblok yet (body field).
      </p>
    </UCard>
  </UContainer>
</template>