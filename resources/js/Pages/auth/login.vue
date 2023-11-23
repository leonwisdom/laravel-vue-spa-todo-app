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
                        Sign in to your account
                    </h1>
                    <!--<Form class="space-y-4 md:space-y-6" id="login-form" @submit="handleLogin" method="post"
                        :validation-schema="loginSchema">
                        <div>
                            <AppInput name="email" type="email" placeholder="Enter email address" label="Your email"
                                :required="true" />
                        </div>
                        <div>
                            <AppInput name="password" type="password" placeholder="Enter password" label="Password"
                                :required="true" />
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                        required="">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <Link href="/auth/forgot-password"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                            password?</Link>
                        </div>

                        <AppButton bclass="w-full" type="submit">
                            Sign In
                        </AppButton>

                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet?
                            <Link href="/auth/register"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</Link>
                        </p>
                    </Form>-->

                    <p>{{  }}</p>
                    <form @submit.prevent="login" className="mt-5">
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
                                Sign In
                            </button>
                        </div>
                    </form>

                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet?
                            <Link href="/auth/register"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</Link>
                        </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { Form } from 'vee-validate';
import * as Yup from 'yup';
import { Link } from '@inertiajs/vue3';
import AppInput from '../../components/AppInput.vue';
import AppButton from '../../components/AppButton.vue';
import { useForm, router } from '@inertiajs/vue3'
// import { useForm } from "@inertiajs/vue3";

const loading = ref(false);


const form = useForm({
    name: '',
    email: '',
    password: '',
});
const login = () => {
    form.post('/auth/authenticate', {
        onSuccess: (response) => {
            if(response.props.failed) {
                
            } else {
                router.visit('/dashboard', { method: 'get' })
            }
        },
        onError: (errors) => {
            console.log(errors)
        }
    });
}

// const loginSchema = Yup.object({
//     email: Yup.string().email('Email is not valid').typeError('Email is required').required('Email is required'),
//     password: Yup.string().required('Password is required'),
// });
// const handleLogin = async (values, actions) => {
//     loading.value = true;

//     console.log('efwfewfefwfw')

//     // const { values, actions } = form;

//     try {
//         const response = await axios.post('/auth/authenticate', values);
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