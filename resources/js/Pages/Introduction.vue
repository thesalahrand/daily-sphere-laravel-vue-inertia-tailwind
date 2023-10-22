<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Introduction" />

  <AuthenticatedLayout>
    <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->
    <div class="space-y-4">
      <div
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
      >
        <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
          What is Daily Sphere?
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
          <a
            href="https://github.com/thesalahrand/daily-sphere-laravel-vue-inertia-tailwind"
            class="text-blue-600 hover:underline dark:text-blue-500"
            >Daily Sphere</a
          >
          is the flagship open-source project of
          <a
            href="https://github.com/thesalahrand"
            class="text-blue-600 hover:underline dark:text-blue-500"
            >Mohammad Salah</a
          >, a concept that had been germinating for a year. Its vision is to
          elegantly and efficiently manage your daily essential tasks. The
          project's founder firmly believes that meticulous tracking elevates
          the importance of any activity. This principle served as the driving
          force behind the project's inception.
          <a
            href="https://github.com/thesalahrand"
            class="text-blue-600 hover:underline dark:text-blue-500"
            >Mohammad Salah</a
          >
          is dedicated to a continuous expansion of features and the integration
          of best practices in the realm of associated technologies.
        </p>
      </div>
      <div
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
      >
        <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
          What is a Tracker?
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
          A tracker is a feature designed to monitor your daily activities with
          grace and precision. It provides comprehensive tracking of your
          activities on a daily, weekly, monthly, yearly, and lifetime basis.
          Notably, you can also access a leaderboard (subject to conditions) for
          each activity, allowing you to engage in friendly competition within
          our community.
        </p>
      </div>
      <div
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
      >
        <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
          How your privacy is protected?
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
          As you may have observed, we uphold a strict policy of not storing any
          personal information, including phone numbers, emails, or addresses.
          We require the use of pseudonyms assuring you that your true identity
          remains completely secure.
        </p>
      </div>
      <div
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
      >
        <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">
          What are the core technologies being used for this project?
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
          <a
            class="text-blue-600 hover:underline dark:text-blue-500"
            href="https://laravel.com/"
            >Laravel</a
          >,
          <a
            class="text-blue-600 hover:underline dark:text-blue-500"
            href="https://vuejs.org/"
            >Vue.js</a
          >,
          <a
            class="text-blue-600 hover:underline dark:text-blue-500"
            href="https://inertiajs.com/"
            >Inertia.js</a
          >,
          <a
            class="text-blue-600 hover:underline dark:text-blue-500"
            href="https://tailwindcss.com/"
            >Tailwind CSS</a
          >
          &
          <a
            class="text-blue-600 hover:underline dark:text-blue-500"
            href="https://flowbite.com/"
            >Flowbite</a
          >.
        </p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
