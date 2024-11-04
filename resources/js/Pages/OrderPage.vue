<script setup>
import { reactive, ref } from 'vue';
import { router, Head, Link, usePage } from '@inertiajs/vue3';
import Card from '@/Components/Bookhaven/Card.vue'
import MainLayout from '@/Layouts/Bookhaven/MainLayout.vue'
import Footer from '@/Components/Bookhaven/Footer.vue'

defineProps({
    books : {
        type : Array,
        required : true
    },
    genre : {
        type : Array,
        required : true
    },
    current : {
        type : Array,
        required : true
    }
})

const data = reactive({
    category : []
})

const handleCheckbox = (e) => {
    const value = e.target.value;

    if (event.target.checked)
    {
        data.category.push(value)
    }
    else
    {
        data.category = data.category.filter(cat => cat !== value)
    }
}

const filter = () => {

    if (data.category.length > 0)
    {
        router.get(route('books'), {
            category : data.category
        });
    }
    else
    {
        router.get(route('books'));
    }

}

const message = usePage().props.flash.message

const error = usePage().props.flash.error

const title = ref("")
const content = ref("")

const view_detail = (_title, _content) => {
    title.value = _title;
    content.value = typeof _content === 'undefined' ? '(No Overview Available)' : _content;

    overview.showModal()
}


</script>

<template>
    <Head title="Books"/>

    <div v-if="message" class="alert alert-success">
        {{ message }}
    </div>

    <div v-if="error" class="alert alert-error">
        {{ error }}
    </div>

    <dialog id="overview" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">{{ title }}</h3>
            <p class="py-4">{{ content }}</p>
            <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn">Close</button>
            </form>
            </div>
        </div>
    </dialog>

    <MainLayout>
        <div class="flex flex-row">
            <aside class="w-80 min-h-screen bg-base-200">
                <div>
                    <ul class="menu h-full sticky">
                        <li v-for="g in genre">
                            <div class="form-control">
                                <label class="label cursor-pointer">
                                    <input type="checkbox" class="checkbox" @change="handleCheckbox" :checked="current.includes(g)" :value="g"/>
                                    <span class="label-text px-3">{{ g.charAt(0).toUpperCase() + g.slice(1) }}</span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <div class="w-full flex justify-center items-center">
                        <button class="btn btn-primary" @click="filter">Filter</button>
                    </div>
                </div>
            </aside>
            <div class="flex flex-col p-5 items-center min-h-screen gap-10 w-full">
                <div class="container p-5 gap-8 grid grid-cols-3" v-if="books.data.length > 0">
                    <Card
                        v-for="book in books.data"
                        :title="book.book_name"
                        :content="book.book_overview"
                        :id="book.id"
                        :author="book.author"
                        :genre="book.genre"
                        :overview="book.overview"
                        :cover_photo="book.cover_photo"
                        :callback="view_detail"
                    />
                </div>

                <div v-else class="self-center p-3">
                    <h1 class="text-2xl">No Results Found...</h1>
                </div>

                <!-- Paginator -->
                <div class="self-end">
                    <div class="join">
                        <Link :href="books.links[0].url" class="join-item btn">«</Link>
                        <Link :href="books.links[1].url" class="join-item btn">Page {{  books.current_page }}</Link>
                        <Link :href="books.links[2].url" class="join-item btn">»</Link>
                    </div>
                </div>


            </div>
        </div>

        <div class="w-full">
            <Footer />
        </div>
    </MainLayout>
</template>
