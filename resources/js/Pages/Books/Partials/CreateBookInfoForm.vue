<template>
    <section>
        <header>
            <div class="text-g font-medium text-white">New Book</div>

            <p class="mt-1 text-sm text-gray-300">

            </p>
        </header>

        <form @submit.prevent="form.post(route('create-book'))" class="space-y-4">
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
                <InputLabel for="overview" value="Book Overview"/>

                <TextInput
                    id="overview"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.book_overview"
                    autofocus
                    autocomplete="name"
                />
            </div>

            <div>
                <InputLabel for="genre" value="Genre"/>

                <select v-model="form.genre" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option :value="g" v-for="g in genre">{{ g }}</option>
                </select>

            </div>

            <div>
                <InputLabel for="published" value="Year Published"/>

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
<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Bookhaven/Dropdown.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    genre : {
        type : Array
    }
})

const form = useForm({
    book_name : "",
    author : "",
    price : 0,
    genre : "",
    book_overview : "",
    year_published : new Date().getFullYear() - 30
})

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
<style lang="">

</style>
