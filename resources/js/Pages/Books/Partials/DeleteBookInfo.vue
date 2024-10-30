<template>
    <section class="space-y-6">

        <header>
            <h2 class="text-lg font-medium text-white">Delete Book</h2>

            <p class="mt-1 text-sm text-gray-300">
                Once you deleted a book, it will be lost forever.
            </p>
        </header>

        <DangerButton @click="confirmBookDeletion">Delete Book</DangerButton>

        <Modal :show="confirmingBookDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete this book?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once the book is deleted, it will not be recovered.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteBook"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteBook"
                    >
                        Delete Book
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const props = defineProps({
    id : {
        type : Number
    }
})

const confirmingBookDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmBookDeletion = () => {
    confirmingBookDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteBook = () => {
    form.delete(route('delete-book', props.id), {
        preserveScroll : true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    })
}


const closeModal = () => {
    confirmingBookDeletion.value = false;

    form.reset();
};

</script>
<style lang="">

</style>
