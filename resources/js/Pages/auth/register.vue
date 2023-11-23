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
                        Sign up for an account
                    </h1>

                    <form @submit.prevent="register" className="mt-5">
                        <div className="mb-3">
                            <label htmlFor="name" className="form-label">Username*</label>
                            <input type="text" v-model="form.username" className="form-control" placeholder="Username*">
                            <div v-if="form.errors.username" class="text-white bg-danger p-2 rounded my-2">{{
                                form.errors.username
                            }}</div>
                        </div>
                        <div className="mb-3">
                            <label htmlFor="email" className="form-label">Email*</label>
                            <input type="text" v-model="form.email" className="form-control" placeholder="Email*">
                            <div v-if="form.errors.email" class="text-white bg-danger p-2 rounded my-2">{{ form.errors.email
                            }}</div>
                        </div>
                        <div className="mb-3">
                            <label htmlFor="password" className="form-label">Password*</label>
                            <input type="password" v-model="form.password" className="form-control" placeholder="Password*">
                            <div v-if="form.errors.password" class="text-white bg-danger p-2 rounded my-2">{{
                                form.errors.password }}</div>
                        </div>
                        <div className="mb-3">
                            <button type="submit" className="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </form>

                    <!--<AppForm @handle-register="handleRegister" handle="handleRegister" form-type="post"
                        :schema="registerSchema" class="space-y-4 md:space-y-6" :loading="loading" submit-text="Sign Up"
                        no-forgot-password>
                    </AppForm>-->

                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account yet?
                        <Link href="/auth/login" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        Sign in</Link>
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import AppForm from '../../components/AppForm.vue';
import { ref } from 'vue';
import * as Yup from 'yup';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { useForm, router } from '@inertiajs/vue3'

const loading = ref(false);

const form = useForm({
    username: '',
    email: '',
    password: '',
});

form.post('/auth/store', {
    onSuccess: (response) => {
        if (response.props.failed) {

        } else {
            router.visit('/dashboard', { method: 'get' })
        }
    },
    // onError: (errors) => {
    //     console.log(errors)
    // }
});
// const registerSchema = {
//     fields: [
//         {
//             label: 'Username',
//             name: 'username',
//             placeholder: 'Enter username',
//             as: 'input',
//             rules: Yup.string().required('Username is required').min(3, 'Username must be at least 3 characters').max(24, 'Username cannot be longer than 24 characters'),
//         },
//         {
//             label: 'Email',
//             name: 'email',
//             placeholder: 'Enter email address',
//             as: 'input',
//             rules: Yup.string().email('Email is not valid').required('Email is required'),
//         },
//         {
//             label: 'Password',
//             name: 'password',
//             placeholder: 'Enter password',
//             as: 'input',
//             type: 'password',
//             rules: Yup.string().required('Password is required')
//                 .min(6, 'Password must be at least 6 characters').max(60, 'Password must not be more than 60 characters'),
//         },
//     ]
// }

// const handleRegister = async (form) => {
//     loading.value = true;

//     const { formData, actions } = form;

//     try {
//         const response = await axios.post('/auth/store', formData);
//         console.log(response);
//         actions.resetForm();
//         router.visit('/', { method: 'get' })
//     } catch (error) {
//         console.log(error)
//         if (error.response.data) {
//             actions.setErrors(error.response.data.errors)
//         }
//     }
// };

</script>

<style lang="scss"></style>