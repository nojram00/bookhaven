<script setup>
import MainLayout from '@/Layouts/Bookhaven/MainLayout.vue'
import UpdateBookInfoForm from './Partials/UpdateBookInfoForm.vue'
import DeleteBookInfo from './Partials/DeleteBookInfo.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    book : {
        type : Object,
        required : true
    },
    genre : {
        type : Array
    }
})

</script>

<template>
    <Head :title="'Edit Book:' + book.book_name " />

    <MainLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Book: {{ book.book_name }}</h2>
        </template>

        <Link href="/dashboard" class="float-left btn btn-error m-3">Back</Link>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-base-200 shadow sm:rounded-lg">
                    <UpdateBookInfoForm
                        :name="book.book_name"
                        :author="book.author"
                        :price="book.price"
                        :id="book.id.toString()"
                        :current_genre="book.genre"
                        :year_published="book.year_published"
                        :genre="genre"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-base-200 shadow sm:rounded-lg">
                    <DeleteBookInfo
                        :id="book.id"
                        class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-base-200 shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<style lang="">

</style>
