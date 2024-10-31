<template>
    <Head title="New Book"/>
    <MainLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Book</h2>
        </template>

        <Link href="/dashboard" class="float-left btn btn-error m-3">Back</Link>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-base-200 shadow sm:rounded-lg">
                    <CreateBookInfoForm
                        class="max-w-xl"
                        :genre="genre"
                    />
                </div>
            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from '@/Layouts/Bookhaven/MainLayout.vue';
import CreateBookInfoForm from './Partials/CreateBookInfoForm.vue';
import { Link, Head } from '@inertiajs/vue3';

defineProps({
    genre : {
        type : Array
    }
})
</script>
<style lang="">

</style>
