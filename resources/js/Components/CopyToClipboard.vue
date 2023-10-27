<script setup>
import IconClipboard from "@/Components/icons/IconClipboard.vue";
import ToastNotification from "@/Components/ToastNotification.vue";
import { ref } from "vue";

const props = defineProps({
  textToCopy: {
    type: String,
  },
});

const showSuccessMsg = ref(false);

const copyToClipboard = async () => {
  try {
    await navigator.clipboard.writeText(props.textToCopy);
    showSuccessMsg.value = true;
    setTimeout(() => (showSuccessMsg.value = false), 3000);
  } catch (err) {
    console.error("Failed to copy: ", err);
  }
};
</script>

<template>
  <IconClipboard classes="w-5 h-5 cursor-pointer" @click="copyToClipboard" />
  <ToastNotification v-if="showSuccessMsg"
    >Tiny URL copied to clipboard</ToastNotification
  >
</template>

<style scoped></style>
