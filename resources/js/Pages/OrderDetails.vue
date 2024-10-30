<template>
    <MainLayout>

        <div v-if="$page.props.flash.message" class="top-0 fixed left-1/2 m-3">
            <div class="alert alert-success">
                {{ $page.props.flash.message }}
            </div>
        </div>

        <div v-if="$page.props.flash.error" class="top-0 fixed left-1/2 m-3">
            <div class="alert alert-error">
                {{ $page.props.flash.error }}
            </div>
        </div>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-base-200 shadow sm:rounded-lg">
                    <h1 class="text-center text-lg text-white">Order Id: <span class="font-bold text-gray-400">{{ order_info.id }}</span></h1>
                    <div class="divider"></div>
                    <div class="flex flex-col gap-5">
                        <h1 class="text-lg">Order Info</h1>
                        <ul>
                            <li class="text-md"><h3>Date Ordered: {{  order_info.date_ordered }}</h3></li>
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <div class="flex flex-col gap-5">
                        <h1 class="text-lg">Book Info</h1>
                        <ul>
                            <li class="text-md"><h3>Book Name: {{  book_info.book_name }}</h3></li>
                            <li class="text-md"><h3>Book Author: {{  book_info.author }}</h3></li>
                            <li class="text-md"><h3>Year Published: {{  book_info.year_published }}</h3></li>
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <div class="flex flex-col gap-5">
                        <h1 class="text-lg">User Info</h1>
                        <ul>
                            <li class="text-md"><h3>Name: {{  user_info.name }}</h3></li>
                            <li class="text-md"><h3>Email: {{  user_info.email }}</h3></li>
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <div>
                        <Link href="/books"><< Back</Link>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from '@/Layouts/Bookhaven/MainLayout.vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    order_info : {
        type : Object
    },
    book_info : {
        type : Object
    },
    user_info : {
        type: Object
    }
});
</script>

