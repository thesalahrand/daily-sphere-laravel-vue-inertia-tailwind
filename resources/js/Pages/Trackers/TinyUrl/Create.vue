<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import IconChevronRight from "@/Components/icons/IconChevronRight.vue";
import InputError from "@/Components/InputError.vue";
import IconArrowPath from "@/Components/icons/IconArrowPath.vue";
import CopyToClipboard from "@/Components/CopyToClipboard.vue";
import ToastNotification from "@/Components/ToastNotification.vue";
import getRandomStr from "@/Utils/getRandomStr";
import { ref } from "vue";

const form = useForm({
  full_url: "",
  tiny_url: getRandomStr(6),
});

const showTinyUrlCreateSuccessMsg = ref(false);

const submit = () => {
  form.post(route("trackers.tiny-urls.store"), {
    onSuccess: () => {
      form.reset("full_url");
      showTinyUrlCreateSuccessMsg.value = true;
      setTimeout(() => (showTinyUrlCreateSuccessMsg.value = false), 3000);
    },
  });
};
</script>

<template>
  <Head title="Create Tiny URL" />

  <AuthenticatedLayout>
    <ToastNotification v-if="showTinyUrlCreateSuccessMsg"
      >Tiny URL created successfully.</ToastNotification
    >

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
        <li>
          <div class="flex items-center">
            <IconChevronRight classes="w-4 h-4 text-gray-400 mr-1" />
            <Link
              :href="route('trackers.tiny-urls.create')"
              class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white"
              >Create</Link
            >
          </div>
        </li>
      </ol>
    </nav>

    <div
      class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
      <form @submit.prevent="submit" class="max-w-xl space-y-6">
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">
          Create a Tiny URL
        </h5>

        <div>
          <label
            for="full_url"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Enter full URL</label
          >
          <input
            type="url"
            name="full_url"
            v-model="form.full_url"
            id="full_url"
            placeholder="e.g. https://github.com/thesalahrand/daily-sphere-laravel-vue-inertia-tailwind"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
            required
          />
          <InputError class="mt-2" :message="form.errors.full_url" />
        </div>

        <div>
          <div class="text-sm flex items-center gap-x-3 mb-2">
            <label
              for="tiny_url"
              class="block font-medium text-gray-900 dark:text-white"
              >Enter tiny URL</label
            >
            <div
              class="flex items-center gap-x-1 text-blue-600 dark:text-blue-500 cursor-pointer"
              @click="form.tiny_url = getRandomStr(6)"
            >
              <IconArrowPath classes="w-4 h-4" />
              <span>Regenerate</span>
            </div>
          </div>
          <input
            type="text"
            name="tiny_url"
            v-model="form.tiny_url"
            id="tiny_url"
            placeholder="e.g. https://github.com/thesalahrand/daily-sphere-laravel-vue-inertia-tailwind"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
            minlength="6"
            maxlength="48"
            pattern="^[A-Za-z0-9_\-]+$"
            required
          />
          <InputError class="mt-2" :message="form.errors.tiny_url" />
          <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            A URL should only consist of alphabets, digits, underscores and
            hyphens. You can either use our randomly generated URL or create
            your own.
          </p>
        </div>

        <div>
          <button
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Save
          </button>
        </div>

        <div
          v-if="$page.props.flash.message"
          class="text-sm text-gray-500 dark:text-gray-400 inline-flex items-center gap-x-1"
        >
          <CopyToClipboard
            :text-to-copy="$page.props.flash.message"
            toast-msg="Tiny URL copied to clipboard."
          />
          <a
            :href="$page.props.flash.message"
            class="text-blue-600 dark:text-blue-500 cursor-pointer underline"
            >{{ $page.props.flash.message }}</a
          >
          is ready to use.
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
