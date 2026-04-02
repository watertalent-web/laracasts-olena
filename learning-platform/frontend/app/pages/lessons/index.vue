<script setup lang="ts">
const storyblokApi = useStoryblokApi()

const { data } = await storyblokApi.get('cdn/stories', {
  version: 'draft'
})
</script>

<template>
  <UContainer class="py-8 md:py-12">
    <UPageHeader
      title="Lessons"
      description="Pick a lesson — content is loaded from Storyblok."
    />

    <div
      v-if="data.stories?.length"
      class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mt-8 md:mt-10"
    >
      <UCard
        v-for="lesson in data.stories"
        :key="lesson.uuid"
        class="group overflow-hidden transition-shadow hover:shadow-md ring-default"
        :ui="{ body: 'p-0' }"
      >
        <NuxtLink
          :to="`/lessons/${lesson.slug}`"
          class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-lg"
        >
          <div class="flex flex-col h-full">
            <div
              class="flex items-start gap-3 p-5 md:p-6 border-b border-default bg-elevated/40"
            >
              <div
                class="shrink-0 flex h-11 w-11 items-center justify-center rounded-lg bg-primary/10 text-primary"
              >
                <UIcon
                  name="i-lucide-book-open"
                  class="size-5"
                />
              </div>
              <div class="min-w-0 flex-1">
                <h3 class="text-base md:text-lg font-semibold text-highlighted group-hover:text-primary transition-colors line-clamp-2">
                  {{ lesson.name }}
                </h3>
                <p
                  v-if="lesson.published_at"
                  class="text-dimmed text-xs mt-1"
                >
                  {{ new Date(lesson.published_at).toLocaleDateString() }}
                </p>
              </div>
            </div>
            <div class="p-5 md:p-6 flex items-center justify-between gap-3 flex-1">
              <span class="text-muted text-sm">Open lesson</span>
              <UIcon
                name="i-lucide-arrow-right"
                class="size-5 text-dimmed group-hover:text-primary group-hover:translate-x-0.5 transition-all shrink-0"
              />
            </div>
          </div>
        </NuxtLink>
      </UCard>
    </div>

    <UCard
      v-else
      class="mt-8"
    >
      <p class="text-muted">
        No published lessons in Storyblok yet.
      </p>
    </UCard>
  </UContainer>
</template>