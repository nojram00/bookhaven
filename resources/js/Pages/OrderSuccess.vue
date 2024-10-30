<template lang="">
    <div class="min-h-screen flex flex-row items-center justify-center">
        <div class="bg-white text-black text-2xl p-10 flex flex-col gap-4 rounded-md shadow-xl">
            <h1 class="text-center">Checkout Success!</h1>

            <h3>Order id: {{ data.id }}</h3>

            <div class="flex flex-row justify-center bg-slate-700 p-5 text-white rounded-md">
                <h3>Book: <b>{{ ordered_book.book_name }}</b></h3>
            </div>
        </div>
    </div>
</template>
<script setup>
defineProps({
    data: {
        type: Object,
        required : true
    },
    ordered_book : {
        type : Object,
        required : true
    },
    ordered_user : {
        type : Object,
        required : true
    }
})
</script>
