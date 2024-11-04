<template>
    <Head title="Book Dashboard"/>
    <MainLayout>

        <div v-if="$page.props.flash.message" @click="$page.props.flash.message = null" class="top-0 cursor-pointer fixed left-1/2 m-3">
            <div class="alert alert-success">
            </div>
        </div>

        <div v-if="$page.props.flash.error" @click="$page.props.flash.error = null" class="top-0 fixed left-1/2 m-3 cursor-pointer">
            <div class="alert alert-error">
                {{ $page.props.flash.error }}
            </div>
        </div>

        <div class="p-4 flex flex-col gap-5">
            <div>
                <Link href="/create-book" as="button" class="text-md float-left btn btn-success">Create</Link>
                <h1 class="text-2xl float-right font-bold">{{ greeting }}, {{ user.name }}!</h1>
            </div>
            <div class="" v-if="books.data.length > 0">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-xl">Book Name</th>
                            <th class="text-xl">Book Author</th>
                            <th class="text-xl">Price</th>
                            <th class="text-xl">Year Published</th>
                            <th class="text-xl">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="book in books.data">
                            <td class="text-lg">{{ book.book_name }}</td>
                            <td class="text-lg">{{ book.author }}</td>
                            <td class="text-lg">{{ book.price }}</td>
                            <td class="text-lg">{{ book.year_published }}</td>
                            <td class="text-lg"><Link :href="`/book/${book.id}`">Action</Link></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="self-center">
                <h1 class="text-2xl">No Records Found</h1>
            </div>

            <div class="self-end p-5">
                <div class="join">
                    <Link :href="books.links[0].url" class="join-item btn">«</Link>
                    <Link :href="books.links[1].url" class="join-item btn">Page {{ books.current_page }}</Link>
                    <Link :href="books.links[2].url" class="join-item btn">»</Link>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from '@/Layouts/Bookhaven/MainLayout.vue';
import { reactive, computed, onMounted, onUnmounted } from 'vue';
import { usePage, Link, Head } from '@inertiajs/vue3';

defineProps({
    books : {
        type : Object,
        required : true
    }
})

const data = reactive({
    time : new Date().toLocaleTimeString()
})

const user = usePage().props.auth.user;

const greeting = computed(() => {
    const hour = new Date().getHours();

    if (hour >= 5 && hour < 12)
    {
        return "Good Morning";
    }
    else if (hour >= 12 && hour < 17)
    {
        return "Good Afternoon";
    }
    else
    {
        return "Good Evening";
    }
});

</script>
