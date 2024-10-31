<template>
    <Head title="Activity Log"/>
    <MainLayout>
        <div class="flex flex-col justify-center items-center w-full">
            <div class="flex p-5 justify-center items-center">
                <h1 class="text-2xl text-bold">Activity Log</h1>
            </div>
            <div class="flex flex-col items-center justify-center p-10 min-w-[1400px]">
                <div class="card bg-primary text-primary-content w-96" v-for="log in logs">
                    <div class="card-body">
                        <h2 class="card-title">{{ convert(log.datetime) }}</h2>
                        <p>{{ log.log }}</p>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from '@/Layouts/Bookhaven/MainLayout.vue';
import { Head } from '@inertiajs/vue3'

defineProps({
    logs : {
        type : Array
    }
})

const convert = (timestamp) => {
    const date = new Date(timestamp)

    const formattedDate = date.toLocaleDateString('en-US', {
        month: '2-digit',
        day: '2-digit',
        year: '2-digit'
    });

    const formattedTime = date.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });

    const formattedTimestamp = formattedDate + ' ' + formattedTime;

    return formattedTimestamp;
}
</script>
<style lang="">

</style>
