<script setup>
import LoginButton from '@/Components/Bookhaven/LoginButton.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="hero min-h-screen" style="background-image: url(/library-with-books.jpg);">
        <div class="hero-overlay bg-opacity-50 bg-slate-800"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Welcome to Bookhaven!</h1>
                <p class="mb-5 text-white">
                    All books you want are here!
                </p>
                <div class="flex gap-3 justify-center">
                    <Link :href="route('login')" class="text-white btn btn-ghost">Login</Link> <Link :href="route('register')" class="text-white btn btn-ghost">Register</Link>
                </div>
            </div>
        </div>
    </div>
</template>
