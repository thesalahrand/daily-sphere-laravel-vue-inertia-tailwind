<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
  availablePseudoNames: {
    type: Array,
  },
});
</script>

<template>
  <Head title="Edit Profile" />

  <AuthenticatedLayout>
    <div
      class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
      <UpdateProfileInformationForm
        :availablePseudoNames="availablePseudoNames"
      />
    </div>

    <div
      class="mt-8 w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
    >
      <UpdatePasswordForm />
    </div>
  </AuthenticatedLayout>
</template>
