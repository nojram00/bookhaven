<template>
    <div class="bg-slate-800 min-h-screen">
        <header class="bg-slate-600 h-[55px] p-3 flex flex-row items-center justify-center">
            <div class="flex-1 flex flex-row items-center">
                <ApplicationLogo class="w-[5rem] h-[3rem] fill-current text-gray-500" />
                <h1 class="text-2xl font-bold text-white ml-10">Bookhaven</h1>
            </div>
            <div class="">
                <ul class="menu menu-vertical lg:menu-horizontal text-md text-white rounded-box">
                    <!-- <li>
                        <Link :href="route('featured')">Featured</Link>
                    </li> -->
                    <li v-if="user.role == 'admin'">
                        <details>
                            <summary>Dashboard</summary>
                            <ul class="w-52 z-[1] p-2">
                                <li><Link :href="route('dashboard')">Books</Link></li>
                                <li><Link :href="route('order-dashboard')">Orders</Link></li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <Link :href="route('books')">Library</Link>
                    </li>
                    <li>
                        <Link :href="route('my-orders')">My Orders</Link>
                    </li>
                    <li>
                        <Link :href="route('profile.edit')">Profile</Link>
                    </li>
                    <li>
                        <Link :href="route('logout')" method="POST">Logout</Link>
                    </li>
                </ul>
            </div>
        </header>
        <slot />
    </div>
</template>
<script setup>
import { Link, usePage } from '@inertiajs/vue3';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
const user = usePage().props.auth.user
</script>
<style lang="">

</style>
