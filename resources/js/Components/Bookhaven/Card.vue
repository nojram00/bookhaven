<template lang="">
    <div class="card card-side bg-base-100 shadow-xl">
        <figure>
            <img
            :src="cover_photo ? '/storage/' + cover_photo : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjH29KmNjFdjfDtuUaUNcoc2mEyL7TDNEIig&s'"
            alt="Movie" />
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ title }}</h2>
            <p>{{ content }}</p>
            <div class="flex flex-col">
                <h1>
                    Author: <span>{{ author }}</span>
                </h1>
                <h1>
                    Genre : <span>{{ genre }}</span>
                </h1>
            </div>

            <div class="card-actions justify-end">
            <button @click="callback(title, overview)" class="btn btn-primary">Overview</button>
            <button @click="order(id)" class="btn btn-primary">Add To Cart</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
defineProps({
    title : {
        type : String
    },
    content : {
        type : String
    },
    author : {
        type : String
    },
    id : {
        type : Number
    },
    genre : {
        type: String
    },
    overview : {
        type: String
    },
    cover_photo : {
        type : String
    },
    callback : {
        type : Object
    }
}) // both of them are undefined

const order = (id) => {
    router.post(route('order', id), {}, {
        headers : {
            'X-History' : route('books')
        }
    })
}

</script>
<style lang="">

</style>
