<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div
    class="min-h-screen flex flex-col sm:justify-center items-center py-6 bg-gray-100"
  >
    <div>
      <Link href="/" class="flex items-center space-x-3">
        <ApplicationLogo
          class="w-9 h-9 fill-current text-gray-900 dark:text-white"
        />
        <h1 class="text-xl font-bold text-gray-900 dark:text-white">
          Daily Sphere
        </h1>
      </Link>
    </div>

    <div
      class="w-full max-w-sm mx-2 mt-6 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
      <slot />
    </div>
  </div>
</template>
