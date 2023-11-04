<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import PopupModal from "@/Components/Modal/PopupModal.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { nextTick, ref, onUnmounted } from "vue";

const userDeleteModalVisibility = ref(false);
const passwordInput = ref(null);

const hideUserDeleteModal = () => {
  userDeleteModalVisibility.value = false;
};

const showUserDeleteModal = () => {
  userDeleteModalVisibility.value = true;

  nextTick(() => passwordInput.value.focus());
};

const page = usePage();
const form = useForm({
  password: "",
});

const deleteUser = () => {
  form.delete(route("profile.destroy"), {
    preserveScroll: true,
    onSuccess: () => {
      const modalBackdrop = document.querySelector("[modal-backdrop]");
      modalBackdrop.remove();
    },
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
};
</script>

<template>
  <section>
    <PopupModal :show="userDeleteModalVisibility" @close="hideUserDeleteModal">
      <div class="px-6 py-6 lg:px-8">
        <form class="space-y-6" @submit.prevent="deleteUser">
          <div>
            <h5 class="text-xl font-semibold text-gray-900 dark:text-white">
              Delete Account
            </h5>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
              Once your account is deleted, all of its resources and data will
              be permanently deleted.
            </p>
          </div>
          <div>
            <label
              for="delete_user_password"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Your password</label
            >
            <input
              type="password"
              name="delete_user_password"
              ref="passwordInput"
              v-model="form.password"
              id="delete_user_password"
              placeholder="••••••••"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
              required
            />
            <InputError class="mt-2" :message="form.errors.password" />
          </div>

          <button
            type="submit"
            class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete Account
          </button>
        </form>
      </div>
    </PopupModal>

    <div class="max-w-xl space-y-6">
      <div>
        <h5 class="text-xl font-semibold text-gray-900 dark:text-white">
          Delete Account
        </h5>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
          Once your account is deleted, all of its resources and data will be
          permanently deleted.
        </p>
      </div>

      <button
        type="button"
        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
        @click="showUserDeleteModal"
      >
        Delete Account
      </button>
    </div>
  </section>
  <!-- <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                your account, please download any data or information that you wish to retain.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Delete Account</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section> -->
</template>
