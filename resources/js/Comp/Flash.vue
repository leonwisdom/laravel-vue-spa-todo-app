<script setup>
import { ref, onMounted } from "vue";
defineProps({
    type: {
        type: String,
        default: 'success',
    },
    message: String,
});

const showFlash = ref(false);

onMounted(() => {
    showFlash.value = true;
    setTimeout(() => {
        showFlash.value = false;
    }, 2500);
});
</script>

<template>
    <div>
        <Transition mode="out-in" name="flash" tag="div" enter-active-class="animate__animated animate__fadeInUp"
            leave-active-class="animate__animated animate__fadeOutDown" appear>
            <p v-if="type == 'error' && showFlash"
                class="cursor-pointer fixed z-10 bottom-3 right-3 bg-red-600 py-5 px-5 font-semibold text-white rounded-xl">
                {{ message }}
            </p>
        </Transition>
        <Transition mode="out-in" name="flash" tag="div" enter-active-class="animate__animated animate__fadeInUp"
            leave-active-class="animate__animated animate__fadeOutDown" appear>
            <p v-if="type == 'success' && showFlash"
                class="cursor-pointer fixed z-10 bottom-3 right-3 bg-green-600 py-5 px-5 font-semibold text-white rounded-xl">
                {{ message }}
            </p>
        </Transition>
    </div>
</template>