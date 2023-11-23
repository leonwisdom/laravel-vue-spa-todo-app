<template>
    <Form class="w-full" @submit="handleSubmit" :type="formType" v-slot="{ meta }">
        <div v-for="{ as, name, placeholder, label, children, ...attrs } in schema.fields" :key="name">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" :for="name">{{ label }}</label>
            <Field
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :as="as" :placeholder="placeholder" :id="name" :name="name" v-bind="attrs">
                <template v-if="children && children.length">
                    <component v-for="({ tag, text, ...childAttrs }, idx) in children" :key="idx" :is="tag"
                        v-bind="childAttrs">
                        {{ text }}
                    </component>
                </template>
            </Field>
            <ErrorMessage :class="{ 'text-rose-500': !meta.valid, ':text-emerald-500': meta.valid }" class="w-full"
                :name="name" />
        </div>
        
        <AppButton bclass="w-full" type="submit">{{ submitText }}</AppButton>
    </Form>
</template>

<script setup>
import { toRefs } from 'vue';
import { configure, Form, Field, ErrorMessage } from 'vee-validate';
import AppButton from './AppButton.vue';

const props = defineProps({
    schema: {
        type: Object,
        required: true,
    },
    handle: {
        type: String,
        default: ''
    },
    formType: {
        type: String,
        default: 'POST',
    },
    submitText: {
        type: String,
        default: 'Submit',
    },
});

const { handle } = toRefs(props);
const emit = defineEmits();

configure({
    validateOnBlur: false,
    validateOnChange: true,
    validateOnInput: false,
    validateOnModelUpdate: true,
});

const handleSubmit = (values, actions) => {
    emit(handle.value.toString(), { formData: values, actions: actions });
}

</script>