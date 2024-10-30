<template>
    <select v-bind="model" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <slot />
    </select>
</template>
<script setup>
defineProps({
    model : {
        type: Object
    }
})
</script>
<style lang="">

</style>
