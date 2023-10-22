<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  availablePseudoNames: {
    type: Array,
  },
});

const form = useForm({
  gender: "Male",
  pseudo_name_id: "",
  password: "",
  password_confirmation: "",
});

const availableFilteredPseudoNames = computed(() => {
  return props.availablePseudoNames.filter(
    (pseudoName) => pseudoName.gender === form.gender
  );
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <form class="space-y-6" @submit.prevent="submit">
      <h5 class="text-xl font-semibold text-gray-900 dark:text-white">
        Sign up to our platform
      </h5>

      <div>
        <label
          for="horizontal-list-radio-male"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Select your gender</label
        >
        <ul
          class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
        >
          <li
            class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
          >
            <div class="flex items-center pl-3">
              <input
                id="horizontal-list-radio-male"
                type="radio"
                value="Male"
                name="gender"
                :checked="form.gender === 'Male'"
                v-model="form.gender"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
              />
              <label
                for="horizontal-list-radio-male"
                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >Male
              </label>
            </div>
          </li>
          <li
            class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
          >
            <div class="flex items-center pl-3">
              <input
                id="horizontal-list-radio-female"
                type="radio"
                value="Female"
                :checked="form.gender === 'Female'"
                v-model="form.gender"
                name="gender"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
              />
              <label
                for="horizontal-list-radio-female"
                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >Female</label
              >
            </div>
          </li>
        </ul>
      </div>

      <div>
        <label
          for="pseudo_name_id"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Select your pseudo name</label
        >
        <select
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          name="pseudo_name_id"
          id="pseudo_name_id"
          autocomplete="pseudo_name_id"
          v-model="form.pseudo_name_id"
          required
        >
          <option selected value="">-- Choose an option --</option>
          <option
            v-for="pseudoName in availableFilteredPseudoNames"
            :key="pseudoName.id"
            :value="pseudoName.id"
          >
            {{ pseudoName.name }}
          </option>
        </select>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
          As a pseudonymous platform, we do not retain users' real identities in
          our records.
        </p>

        <InputError class="mt-2" :message="form.errors.pseudo_name_id" />
      </div>

      <div>
        <label
          for="password"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Your password</label
        >
        <input
          type="password"
          name="password"
          v-model="form.password"
          id="password"
          placeholder="••••••••"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
          required
        />
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
          Please ensure that you securely store your password, as we currently
          do not offer a
          <span class="font-semibold">Forgot Password</span> feature.
        </p>
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div>
        <label
          for="password_confirmation"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Confirm password</label
        >
        <input
          type="password"
          name="password_confirmation"
          v-model="form.password_confirmation"
          id="password_confirmation"
          placeholder="••••••••"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
          required
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <button
        type="submit"
        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Register
      </button>

      <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
        Already registered?
        <Link
          :href="route('login')"
          class="text-blue-700 hover:underline dark:text-blue-500"
          >Login now</Link
        >
      </div>
    </form>
  </GuestLayout>
</template>
