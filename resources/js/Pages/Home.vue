<template>
    <div class="h-screen flex m-auto items-center justify-center">
        <img class="z-[1] w-screen absolute h-screen cover" alt="home image" src="../../assets/img/home.jpeg" />

        <div class="z-20 bg-white w-96 p-10 mx-auto text-center rounded">
            <h1 class="text-3xl mb-12 text-indigo-600">To-Do List App</h1>

            <Link class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-3" href="/auth/login">Login</Link>
            <Link class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded ml-3" href="/auth/register">Register</Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

</script>