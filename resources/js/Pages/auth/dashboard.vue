<template>
    <div class="max-w-7xl mx-auto px-80">
        <h1 class="text-3xl pt-20 text-indigo-600 hover:text-indigo-400">To-Do List App</h1>

        <div class="flex mx-auto">
            <AppForm @handle-new-note="handleNewNote" handle="handleNewNote" form-type="post" :schema="newNoteSchema"
                class="py-12" data-np-autofill-form-type="register" data-np-checked="1" :loading="loading"
                data-np-watching="1" submit-text="Sign Up" no-forgot-password>
            </AppForm>
        </div>

        <div class="p-80">

        </div>

    </div>
</template>

<script setup>
import AppForm from '../../components/AppForm.vue';
import * as Yup from 'yup';

const newNoteSchema = {
    fields: [
        {
            label: 'Note',
            placeholder: 'Enter Note',
            name: 'username',
            as: 'textarea',
            rules: Yup.string().required('Note is required'),
        }
    ]
}

const handleNewNote = async (form) => {
    loading.value = true;

    const { formData, resetForm } = form;

    try {
        const response = await axios.post('/api/note', formData);
        console.log(response);
        resetForm();
    } catch (error) {
        console.log(error);
    }
};

</script>