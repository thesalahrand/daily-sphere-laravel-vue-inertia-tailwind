<script setup>
import IconXMark from "@/Components/icons/IconXMark.vue";
import { onMounted, watch } from "vue";

const props = defineProps({
  show: {
    type: Boolean,
  },
});

const emit = defineEmits(["close"]);

let popupModal;

onMounted(() => {
  const $targetPopupModalEl = document.getElementById("popup-modal");
  popupModal = new Modal($targetPopupModalEl, {
    onHide: () => emit("close"),
  });
});

watch(
  () => props.show,
  (newValue) => popupModal[newValue ? "show" : "hide"]()
);
</script>

<template>
  <Teleport to="body">
    <div
      id="popup-modal"
      tabindex="-1"
      class="fixed top-0 left-0 right-0 z-[51] hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
      <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button
            type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            @click="emit('close')"
          >
            <IconXMark classes="w-6 h-6" />
            <span class="sr-only">Close modal</span>
          </button>

          <slot />
        </div>
      </div>
    </div>
  </Teleport>
</template>

<style scoped></style>
