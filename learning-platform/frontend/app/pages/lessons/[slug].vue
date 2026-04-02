<script setup lang="ts">
const route = useRoute()
const storyblokApi = useStoryblokApi()

const { data } = await storyblokApi.get(`cdn/stories/${route.params.slug}`, {
  version: 'draft'
})

const story = computed(() => data.story)
console.log(story.value.content);

const description = computed(() => {
  const c = story.value?.content as Record<string, unknown> | undefined
  if (!c) return undefined
  const d = c.description ?? c.teaser ?? c.intro
  return typeof d === 'string' ? d : undefined
})
</script>

<template>
  <UContainer class="py-8 md:py-12 max-w-5xl">
    <div class="mb-10 md:mb-12">
      <UPageHeader
        :title="story.name"
        :description="description"
        :links="[
          {
            label: 'All lessons',
            to: '/lessons',
            color: 'neutral',
            variant: 'subtle',
            icon: 'i-lucide-arrow-left'
          }
        ]"
      />
    </div>

    <div
      v-if="(story.content?.body?.length ?? 0) > 0"
      class="space-y-2 md:space-y-4"
    >
      <div
        v-for="blok in story.content?.body ?? []"
        :key="blok._uid"
        class="rounded-xl border border-default bg-elevated/30 p-4 md:p-8 transition-colors hover:bg-elevated/50"
      >
        <component
          :is="blok.component"
          :blok="blok"
        />
      </div>
    </div>

    <UCard
      v-else
      class="mt-6"
    >
      <p class="text-muted">
        Lesson content has not been added in Storyblok yet (body field).
      </p>
    </UCard>
  </UContainer>
</template>