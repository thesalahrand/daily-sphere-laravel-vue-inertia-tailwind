<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import IconChevronRight from "@/Components/icons/IconChevronRight.vue";
import InputError from "@/Components/InputError.vue";
import IconPlus from "@/Components/icons/IconPlus.vue";
import CopyToClipboard from "@/Components/CopyToClipboard.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
  tinyUrls: {
    type: Object,
  },
});
</script>

<template>
  <Head title="Tiny URLs" />

  <AuthenticatedLayout>
    <nav class="flex mb-4" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
          <Link
            :href="route('trackers.tiny-urls.index')"
            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
          >
            Tiny URLs
          </Link>
        </li>
      </ol>
    </nav>

    <div class="flex items-center justify-between mb-4">
      <h5 class="text-xl font-semibold text-gray-900 dark:text-white">
        Tiny URLs
      </h5>
      <Link
        :href="route('trackers.tiny-urls.create')"
        class="flex items-center gap-x-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      >
        <IconPlus classes="w-4 h-4" :stroke-width="3" />
        Create
      </Link>
    </div>

    <div class="relative overflow-x-auto mb-4">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">Full URL</th>
            <th scope="col" class="px-6 py-3">Tiny URL</th>
            <th scope="col" class="px-6 py-3">Last Updated</th>
            <th scope="col" class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            v-for="tinyUrl in tinyUrls.data"
            :key="tinyUrl.id"
          >
            <td class="px-6 py-4">
              <div class="inline-flex gap-x-1">
                <CopyToClipboard
                  :text-to-copy="tinyUrl.full_url"
                  toast-msg="Full URL copied to clipboard."
                />
                <a
                  :href="tinyUrl.full_url"
                  class="text-blue-600 dark:text-blue-500 cursor-pointer underline"
                  >{{
                    tinyUrl.full_url.length > 48
                      ? `${tinyUrl.full_url.substring(0, 48)}...`
                      : tinyUrl.full_url
                  }}</a
                >
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="inline-flex gap-x-1">
                <CopyToClipboard
                  :text-to-copy="tinyUrl.tiny_url"
                  toast-msg="Tiny URL copied to clipboard."
                />
                <Link
                  :href="route('introduction')"
                  class="text-blue-600 dark:text-blue-500 cursor-pointer underline"
                  >{{ tinyUrl.tiny_url }}</Link
                >
              </div>
            </td>
            <td class="px-6 py-4">{{ tinyUrl.updated_at }}</td>
            <td class="px-6 py-4">
              <div class="inline-flex gap-x-2">
                <Link
                  type="button"
                  class="px-3 py-2 text-xs font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                >
                  Edit
                </Link>
                <Link
                  type="button"
                  class="px-3 py-2 mr-2 text-xs font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                >
                  Delete
                </Link>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <Pagination :items="tinyUrls" />
  </AuthenticatedLayout>
</template>

<style scoped></style>
