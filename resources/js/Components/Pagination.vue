<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  items: {
    type: Object,
  },
});
</script>

<template>
  <nav
    class="flex items-center justify-between pt-4"
    aria-label="Table navigation"
  >
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400"
      >Showing
      <span class="font-semibold text-gray-900 dark:text-white"
        >{{ items.from }}-{{ items.to }}</span
      >
      of
      <span class="font-semibold text-gray-900 dark:text-white">{{
        items.total
      }}</span></span
    >
    <ul class="inline-flex -space-x-px text-sm h-8">
      <li v-for="(link, idx) in items.links" :key="idx">
        <Component
          :is="link.url ? Link : 'span'"
          :href="link.url"
          class="flex items-center justify-center px-3 h-8 border border-gray-300 dark:border-gray-700"
          :class="{
            'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white':
              link.active,
            'leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white':
              !link.active,
            'rounded-l-lg': !idx,
            'rounded-r-lg': items.links.length - 1 == idx,
          }"
        >
          <span v-html="link.label"></span>
        </Component>
      </li>
    </ul>
  </nav>
</template>

<style scoped></style>
