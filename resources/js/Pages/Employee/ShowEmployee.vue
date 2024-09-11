<template>
    <Head title="Employee Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Employee Details</h2>
        </template>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <div v-if="employee">
                <p><strong>First Name:</strong> {{ employee.data.first_name }}</p>
                <p><strong>Last Name:</strong> {{ employee.data.last_name }}</p>
                <p><strong>Email:</strong> {{ employee.data.email }}</p>
                <p><strong>Phone:</strong> {{ employee.data.phone }}</p>
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
    employee: Object
});

</script>

<style scoped>
/* Add your styles here */
</style>
