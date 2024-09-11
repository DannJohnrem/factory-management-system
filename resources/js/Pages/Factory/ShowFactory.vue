<template>
    <Head title="Factory Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Factory Details</h2>
        </template>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <div v-if="factory">
                <p><strong>Factory Name:</strong> {{ factory.data.factory_name }}</p>
                <p><strong>Location:</strong> {{ factory.data.location }}</p>
                <p><strong>Email:</strong> {{ factory.data.email }}</p>
                <p><strong>Website:</strong> {{ factory.data.website }}</p>
            </div>
            <div v-else>
                <p>Loading...</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    factory: Object
});

console.log(props.factory);
</script>

<style scoped>
/* Add your styles here */
</style>
