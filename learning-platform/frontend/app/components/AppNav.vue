<script setup lang="ts">
const links = [
  { label: 'Home page', to: '/' },
  { label: 'Lessons', to: '/lessons' },
  { label: 'Categories', to: '/categories' },
  { label: 'Authors', to: '/authors' },
  { label: 'Global settings', to: '/settings' }
] as const

const route = useRoute()

const navItems = computed(() =>
  links.map((l) => ({
    label: l.label,
    to: l.to,
    active: route.path === l.to
  }))
)
</script>

<template>
  <UHeader title="Learning Platform" to="/">
    <UNavigationMenu
      :items="navItems"
      variant="link"
      class="w-full justify-center"
    />
  </UHeader>
</template>
