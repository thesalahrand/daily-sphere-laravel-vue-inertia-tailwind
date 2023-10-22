<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Introduction" />

  <AuthenticatedLayout>
    <h2
      class="font-bold text-xl text-gray-800 dark:text-white leading-tight mb-4"
    >
      Attributions
    </h2>

    <p class="font-normal text-gray-700 dark:text-gray-400">
      We extend our appreciation to the skilled designers behind the icons we've
      incorporated into our project. While they may not be direct contributors,
      their artistry has significantly enriched our platform, and we acknowledge
      their creative contributions, which enhance our project's visual appeal.
    </p>

    <ul class="list-decimal ml-4 mt-4">
      <li>
        <a
          class="text-blue-600 hover:underline dark:text-blue-500"
          href="https://www.flaticon.com/free-icons/prayer"
          title="prayer icons"
          >Prayer icons created by amonrat rungreangfangsai - Flaticon</a
        >
      </li>
      <li>
        <a
          class="text-blue-600 hover:underline dark:text-blue-500"
          href="https://www.flaticon.com/free-icons/budget"
          title="budget icons"
          >Budget icons created by Freepik - Flaticon</a
        >
      </li>
      <li>
        <a
          class="text-blue-600 hover:underline dark:text-blue-500"
          href="https://www.flaticon.com/free-icons/ramadan"
          title="ramadan icons"
          >Ramadan icons created by Freepik - Flaticon</a
        >
      </li>
      <li>
        <a
          class="text-blue-600 hover:underline dark:text-blue-500"
          href="https://www.flaticon.com/free-icons/url"
          title="url icons"
          >Url icons created by Karacis - Flaticon</a
        >
      </li>
      <li>
        <a
          class="text-blue-600 hover:underline dark:text-blue-500"
          href="https://www.flaticon.com/free-icons/attribute"
          title="attribute icons"
          >Attribute icons created by alexdndz - Flaticon</a
        >
      </li>
    </ul>
  </AuthenticatedLayout>
</template>
