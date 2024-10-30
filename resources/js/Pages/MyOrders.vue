<template lang="">
    <MainLayout>
        <div class="flex flex-row">
            <!-- <aside class="w-80 min-h-screen bg-base-200">
                <div>
                    <ul class="menu h-full sticky">

                    </ul>
                    <div class="w-full flex justify-center items-center">

                    </div>
                </div>
            </aside> -->

            <div class="flex flex-col p-5 gap-10 w-full">

                <!-- Pagination Top -->
                <div class="flex self-end">
                    <div class="join">
                        <Link as="button" :href="orders.links[0].url" class="join-item btn">«</Link>
                        <Link as="button" :href="orders.links[1].url" class="join-item btn">Page {{ orders.current_page }}</Link>
                        <Link as="button" :href="orders.links[2].url" class="join-item btn">»</Link>
                    </div>
                </div>

                <div class="flex flex-col flex-1 gap-5">
                    <div v-for="order in orders.data" class="
                        card bg-base-200
                        rounded-box grid h-auto
                        place-items-center p-6">
                            <div class="card-body flex flex-col gap-3">
                                <div class="card-title">Order {{ order.id }}</div>
                                <div class="flex flex-col">
                                    <div>
                                        <h3>Transaction Date: <span>{{ order.date_ordered }}</span></h3>
                                    </div>
                                </div>
                                <div class="card-actions">
                                    <Link :href="`/order/${order.id}`" class="float-left">
                                        View Transaction
                                    </Link>
                                </div>
                            </div>

                    </div>
                </div>

                <!-- Pagination Bottom -->
                <div class="flex self-end">
                    <div class="join">
                        <Link as="button" :href="orders.links[0].url" class="join-item btn">«</Link>
                        <Link as="button" :href="orders.links[1].url" class="join-item btn">Page {{ orders.current_page }}</Link>
                        <Link as="button" :href="orders.links[2].url" class="join-item btn">»</Link>
                    </div>
                </div>

            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/Bookhaven/MainLayout.vue'
defineProps({
    orders : {
        type : Object,
        required : true
    }
})
</script>
<style lang="">

</style>
