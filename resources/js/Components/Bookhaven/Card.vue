<template>
    <div class="card card-side bg-base-100 shadow-xl">
        <figure>
            <img
            :src=" image ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjH29KmNjFdjfDtuUaUNcoc2mEyL7TDNEIig&s'"
            alt="Movie" />
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ props.title }}</h2>
            <p>{{ content }}</p>
            <div class="flex flex-col">
                <h1>
                    Author: <span>{{ props.author }}</span>
                </h1>
                <h1>
                    Genre : <span>{{ props.genre }}</span>
                </h1>
            </div>

            <div class="card-actions justify-end">
            <button @click="callback(props.title, props.overview)" class="btn btn-primary">Overview</button>
            <button @click="order(props.id)" class="btn btn-primary">Add To Cart</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import axios from 'axios';
import { onMounted, ref } from 'vue';
const props = defineProps({
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
    },
    cover_url : {
        type : String
    }
}) // both of them are undefined

const order = (id) => {
    router.post(route('order', id), {}, {
        headers : {
            'X-History' : route('books')
        }
    })
}

const image = ref(null)


const get_image = async () => {

    if(props.cover_url == null)
    {
        return
    }

    try {
        const res = await axios.get(props.cover_url)

        if(res.status === 200)
        {
            image.value = res.data.image;
        }

    } catch (error) {

    }
}

onMounted(async () => {
    await get_image()
});

</script>
<style lang="">

</style>
