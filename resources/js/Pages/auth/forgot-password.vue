<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                Awesome To-do List App
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Forgot password
                    </h1>

                    <AppForm @handle-login="handleForgotPassword" handle="handleForgotPassword" form-type="post" :schema="forgotPasswordSchema"
                        class="space-y-4 md:space-y-6" :loading="loading"
                        submit-text="Submit">
                    </AppForm>

                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Remember your password?
                        <Link href="/auth/login"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign in</Link>
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import AppForm from '../../components/AppForm.vue';
import * as Yup from 'yup';
import { Link } from '@inertiajs/vue3';

const loading = ref(false);

const forgotPasswordSchema = {
    fields: [
        {
            label: 'Email',
            name: 'email',
            placeholder: 'Enter email address',
            as: 'input',
            rules: Yup.string().email('Email is not valid').required('Email is required'),
        }
    ],
};

const handleForgotPassword = async (form) => {
    loading.value = true;

    const { formData, resetForm } = form;

    try {
        const response = await axios.post('/api/forgot-password', formData);
        console.log(response);
        resetForm();
    } catch (error) {
        console.log(error);
    }
};

</script>

<style lang="scss"></style>