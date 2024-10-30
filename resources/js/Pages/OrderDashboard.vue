<template>
    <MainLayout>
        <div class="p-4 flex flex-col gap-5">
            <div>
                <h1 class="text-2xl float-right font-bold">{{ greeting }}, {{ user.name }}!</h1>
            </div>
            <div class="" v-if="orders.data.length > 0">
                <table class="table flex-1">
                    <thead>
                        <tr>
                            <th class="text-xl">Book Name</th>
                            <th class="text-xl">Date Ordered</th>
                            <th class="text-xl">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders.data">
                            <td class="text-lg">{{ order.id }}</td>
                            <td class="text-lg">{{ order.date_ordered }}</td>
                            <td class="text-lg"><button @click="view_action(order.id)">View Order</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else class="self-center min-h-screen">
                <h1 class="text-2xl">No Records Found</h1>
            </div>

            <div class="self-end p-5">
                <div class="join">
                    <Link :href="orders.links[0].url" class="join-item btn">«</Link>
                    <Link :href="orders.links[1].url" class="join-item btn">Page {{ orders.current_page }}</Link>
                    <Link :href="orders.links[2].url" class="join-item btn">»</Link>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import MainLayout from '@/Layouts/Bookhaven/MainLayout.vue';
import { reactive, computed, onMounted, onUnmounted } from 'vue';
import { usePage, Link, router } from '@inertiajs/vue3';

defineProps({
    orders : {
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

const view_action = (id) => {
    router.get(route('order-info', id), {} , {
        headers : {
            'X-History' : route('order-dashboard')
        }
    })
}

</script>
