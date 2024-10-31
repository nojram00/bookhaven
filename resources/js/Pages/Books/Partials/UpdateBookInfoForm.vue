<script setup>
import { useForm, router } from "@inertiajs/vue3";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Bookhaven/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import { computed, ref } from "vue";

const props = defineProps({
    name : {
        type : String,
        required : true
    },
    author : {
        type : String,
        required : true
    },
    price : {
        type : String,
        required : true
    },
    id : {
        type : String
    },
    genre : {
        type : Array
    },
    current_genre : {
        type : String
    },
    year_published : {
        type : Number
    }
})

const form = useForm({
    book_name : props.name,
    author : props.author,
    price : props.price,
    genre : props.current_genre,
    year_published : props.year_published,
    cover_photo : null
})

const cover_photo = ref(null)

const handleFile = (event) => {
    form.cover_photo = event.target.files[0];

    console.log(form.cover_photo)
}

const handleSubmit = () => {
    const data = new FormData()

    data.append('book_name', form.book_name)
    data.append('author', form.author)
    data.append('price', form.price)
    data.append('genre', form.genre)
    data.append('year_published', form.year_published)

    if(form.cover_photo !== null)
    {
        data.append('cover_photo', cover_photo)
    }


    form.post(route('save-book', props.id), data, {
        forceFormData : true
    });

}

const years = computed(() => {
    const current_year = new Date().getFullYear()
    const years_array = []

    for (let year = current_year - 200; year <= current_year + 50; year++)
    {
        years_array.push(year)
    }

    return years_array;
});

</script>

<template>
    <!-- <div class="absolute top-0 bg-green-400 text-black p-3 left-1/2 transform -translate-x-1/2 rounded-bl-md rounded-br-md">
        Success!
    </div> -->
    <section>
        <header>
            <div class="text-g font-medium text-white">Book Information</div>

            <p class="mt-1 text-sm text-gray-300">

            </p>
        </header>



        <form @submit.prevent="handleSubmit" class="space-y-4">
            <div>
                <InputLabel for="book-name" value="Book Name"/>

                <TextInput
                    id="book-name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.book_name"
                    required
                    autofocus
                    autocomplete="name"
                />

            </div>

            <div>
                <InputLabel for="book-author" value="Book Author"/>

                <TextInput
                    id="book-author"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.author"
                    required
                    autofocus
                    autocomplete="name"
                />

            </div>

            <div>
                <InputLabel for="price" value="Price"/>

                <TextInput
                    id="price"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.price"
                    required
                    autofocus
                    autocomplete="name"
                />

            </div>

            <div>
                <InputLabel for="cover" value="Cover Photo"/>

                <input type="file" id="cover" @change="handleFile" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm m-1 block w-full">
                </input>
            </div>

            <div>
                <InputLabel for="genre" value="Genre"/>

                <select v-model="form.genre" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option :value="g" v-for="g in genre">{{ g }}</option>
                </select>

            </div>

            <div>
                <InputLabel for="year" value="Year Published"/>

                <select v-model="form.year_published" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option :value="year" v-for="year in years">{{ year }}</option>
                </select>

            </div>

            <div class="flex items-center gap-4 mt-5">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>

    </section>
</template>

<style lang="">

</style>
