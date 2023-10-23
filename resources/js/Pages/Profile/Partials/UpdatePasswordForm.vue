<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
  current_password: "",
  password: "",
  password_confirmation: "",
});

const updatePassword = () => {
  form.put(route("password.update"), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset("password", "password_confirmation");
        passwordInput.value.focus();
      }
      if (form.errors.current_password) {
        form.reset("current_password");
        currentPasswordInput.value.focus();
      }
    },
  });
};
</script>

<template>
  <section>
    <form @submit.prevent="updatePassword" class="max-w-xl space-y-6">
      <div>
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">
          Update Password
        </h5>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
          Please ensure that you securely store your password, as we currently
          do not offer a
          <span class="font-semibold">Forgot Password</span> feature.
        </p>
      </div>

      <div>
        <label
          for="current_password"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Current Password</label
        >
        <input
          type="password"
          name="current_password"
          v-model="form.current_password"
          ref="currentPasswordInput"
          id="password"
          placeholder="••••••••"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
          autocomplete="current_password"
          required
        />
        <InputError :message="form.errors.current_password" class="mt-2" />
      </div>

      <div>
        <label
          for="password"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >New Password</label
        >
        <input
          type="password"
          name="password"
          v-model="form.password"
          ref="passwordInput"
          id="password"
          placeholder="••••••••"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
          autocomplete="password"
          required
        />
        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <div>
        <label
          for="password_confirmation"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Confirm Password</label
        >
        <input
          type="password"
          name="password_confirmation"
          v-model="form.password_confirmation"
          id="password_confirmation"
          placeholder="••••••••"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
          autocomplete="password_confirmation"
          required
        />
        <InputError :message="form.errors.password_confirmation" class="mt-2" />
      </div>

      <div class="flex items-center gap-4">
        <button
          type="submit"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Save
        </button>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p
            v-if="form.recentlySuccessful"
            class="text-sm text-green-600 dark:text-green-500"
          >
            Saved.
          </p>
        </Transition>
      </div>
    </form>
  </section>
</template>
