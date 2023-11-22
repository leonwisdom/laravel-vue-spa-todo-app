<template>
    <div>
        <button :disabled="disabled" :class="[bclass, 'bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded']">
            <slot></slot>
        </button>
    </div>
</template>

<script setup>
const props = defineProps({
    bclass: {
        type: String,
        default: ''
    },
    disabled: {
        type: Boolean,
        default: false
    }
})
</script>

<style lang="scss">

</style>