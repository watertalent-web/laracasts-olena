<script setup lang="ts">
import { contentBlockTypes } from '~/components/blocks/registry'

const faqItems = [
  { label: 'What is this platform?', content: 'A place to learn with structured lessons and categories.' },
  { label: 'How do I start?', content: 'Open Lessons and pick a topic that matches your level.' }
]

const featureList = [
  { icon: 'i-lucide-book-open', title: 'Lessons', description: 'Step-by-step materials.' },
  { icon: 'i-lucide-folder-tree', title: 'Categories', description: 'Topics grouped for easy navigation.' },
  { icon: 'i-lucide-users', title: 'Authors', description: 'Learn from curated authors.' }
]
</script>

<template>
  <div>
    <BlockHero
      headline="Learning Platform"
      title="Build skills at your pace"
      description="Browse lessons, explore categories, and follow authors — all in one place."
      :links="[
        { label: 'View lessons', to: '/lessons' },
        { label: 'Categories', color: 'neutral', variant: 'subtle', to: '/categories' }
      ]"
    />

    <BlockRichText title="Welcome">
      <p>
        This home page demonstrates content blocks you can reuse across the app: Hero, Rich text, Features,
        CTA, and FAQ.
      </p>
    </BlockRichText>

    <BlockFeatures
      headline="Blocks"
      title="Section building blocks"
      description="Composable sections for landing pages and lesson intros."
      :features="featureList"
    />

    <BlockCta
      title="Ready to explore?"
      description="Jump into lessons or adjust global settings anytime."
      :links="[
        { label: 'Lessons', to: '/lessons' },
        { label: 'Global settings', color: 'neutral', variant: 'outline', to: '/settings' }
      ]"
    />

    <BlockFaq headline="FAQ" title="Frequently asked questions" :items="faqItems" />

    <UContainer class="py-6">
      <UCard>
        <template #header>
          <h2 class="text-lg font-semibold">Content block types</h2>
        </template>
        <ul class="list-disc space-y-1 pl-5 text-muted">
          <li v-for="b in contentBlockTypes" :key="b.id">
            {{ b.label }}
            <span class="text-dimmed">({{ b.id }})</span>
          </li>
        </ul>
      </UCard>
    </UContainer>
  </div>
</template>
