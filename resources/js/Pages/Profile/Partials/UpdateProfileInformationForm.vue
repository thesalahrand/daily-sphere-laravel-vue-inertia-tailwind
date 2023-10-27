<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
  availablePseudoNames: {
    type: Array,
  },
});

const user = ref(usePage().props.auth.user);

const form = useForm({
  _method: "patch",
  pseudo_name_id: user.value.pseudo_name_id,
  profile_pic: null,
});

const availableFilteredPseudoNames = computed(() => {
  return [
    {
      id: user.value.pseudo_name_id,
      name: user.value.pseudo_name,
      gender: user.value.gender,
    },
  ].concat(
    props.availablePseudoNames.filter(
      (pseudoName) => pseudoName.gender === user.value.gender
    )
  );
});

const submit = () => {
  form.post(route("profile.update"), {
    onSuccess: () => (user.value = usePage().props.auth.user),
  });
};
</script>

<template>
  <section>
    <div class="space-y-4 mb-6">
      <h5 class="text-xl font-semibold text-gray-900 dark:text-white">
        Profile Information
      </h5>

      <div class="flex items-center space-x-4">
        <img
          class="w-36 h-36 rounded-full object-cover"
          :src="
            $page.props.auth.user.profile_pic
              ? `/storage/${$page.props.auth.user.profile_pic}`
              : `/images/${$page.props.auth.user.gender.toLowerCase()}.png`
          "
          alt="profile-pic"
        />
        <div class="space-y-1">
          <h4 class="text-base font-semibold text-gray-900 dark:text-white">
            {{ $page.props.auth.user.pseudo_name }}
          </h4>
          <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $page.props.auth.user.gender }}
          </p>
          <p class="text-sm text-gray-500 dark:text-gray-400">
            Joined in {{ $page.props.auth.user.joined_in }}
          </p>
        </div>
      </div>
    </div>
    <form @submit.prevent="submit" class="max-w-xl space-y-6">
      <div>
        <label
          for="pseudo_name_id"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Your pseudo name</label
        >
        <select
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          name="pseudo_name_id"
          id="pseudo_name_id"
          autocomplete="pseudo_name_id"
          v-model="form.pseudo_name_id"
          required
        >
          <option value="">-- Choose an option --</option>
          <option
            v-for="pseudoName in availableFilteredPseudoNames"
            :key="pseudoName.id"
            :value="pseudoName.id"
            :selected="form.pseudo_name_id === pseudoName.id"
          >
            {{ pseudoName.name }}
          </option>
        </select>
        <InputError class="mt-2" :message="form.errors.pseudo_name_id" />
      </div>

      <div>
        <label
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="profile_pic"
          >Upload your picture</label
        >
        <input
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          id="profile_pic"
          type="file"
          @input="form.profile_pic = $event.target.files[0]"
        />
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
          Image uploads are limited to a maximum of
          <span class="font-semibold">1 MB</span> in size and must be in either
          <span class="font-semibold">JPG</span> or
          <span class="font-semibold">PNG</span> format
        </p>
        <InputError class="mt-2" :message="form.errors.profile_pic" />
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
