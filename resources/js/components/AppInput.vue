<template>
    <div class="group" :class="{ invalid: !!errorMessage, valid: meta.valid }">
        <div>
            <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
            <input :type="type" :id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :placeholder="placeholder" :value="inputValue" @input="handleChange" @blur="handleBlur" :required="required">
        </div>

        <p class="help-message w-full text-sm w-100">
            <span class="help-message group-[.invalid]:text-rose-500 group-[.valid]:text-emerald-500"
                v-show="errorMessage && meta.touched || meta.valid && meta.touched">{{ errorMessage
                    || successMessage }}</span>
        </p>
    </div>
</template>

<script setup>
import { useField } from 'vee-validate';

const props = defineProps({
    name: {
        type: String,
        default: 'name'
    },
    label: {
        type: String,
        default: ''
    },
    type: {
        type: String,
        default: 'text'
    },
    placeholder: {
        type: String,
        default: ''
    },
    required: {
        type: Boolean,
        default: false
    }
})

const {
    value: inputValue,
    errorMessage,
    handleBlur,
    handleChange,
    meta,
} = useField(props.name, undefined, {
    initialValue: props.value,
});
</script>

<style lang="scss"></style>