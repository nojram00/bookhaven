<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-800">
        <div>
            <Link href="/">
                <!-- <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" /> -->
                 <h1 class="text-white text-2xl">Bookhaven</h1>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-slate-600 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
