<template>

    <Head title="Employee List" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Employee List</h2>
        </template>
        <template #link>
            <Link :href="route('employee.create')"
                class="flex items-center justify-center gap-2 px-3 py-2 font-semibold text-white bg-indigo-500 rounded hover:bg-indigo-700">
            <span>New Role</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>

            </Link>
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <div class="w-full mb-8 overflow-hidden border rounded-lg shadow-sm dark:border-gray-600">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 bg-gray-50">
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">First Name</th>
                                <th scope="col" class="px-6 py-3">Last Name</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Phone</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-600 dark:bg-gray-700">
                            <tr v-for="employee in employees.data" :key="employee.id"
                                class="text-gray-700 dark:text-gray-400">
                                <td class="px-6 py-3 text-sm"> {{ employee.id }}</td>
                                <td class="px-6 py-3 text-sm"> {{ employee.first_name }}</td>
                                <td class="px-6 py-3 text-sm"> {{ employee.last_name }}</td>
                                <td class="px-6 py-3 text-sm"> {{ employee.email }}</td>
                                <td class="px-6 py-3 text-sm"> {{ employee.phone }}</td>
                                <td class="inline-flex gap-2 px-6 py-3 text-sm align-middle">
                                    <Link :href="route('employee.show', employee.id)"
                                        class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    </Link>
                                    <Link :href="route('employee.edit', employee.id)"
                                        class="text-green-500 hover:text-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    </Link>
                                    <button @click="confirmDeleteEmployee(employee.id)"
                                        class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="employees.data.length === 0">
                                <td colspan="6" class="px-6 py-3 text-sm font-bold text-center text-gray-500 uppercase">
                                    No data available
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:bg-gray-800 dark:border-gray-600 bg-gray-50 sm:grid-cols-9">
                    <Pagination :links="employees.links" :current-page="employees.current_page"
                        :items-per-page="itemsPerPage" :total-items="employees.total" @updateItemsPerPage="fetchData" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Swal from 'sweetalert2';
import axios from "axios";

const props = defineProps({
    employees: Object
});

const itemsPerPage = ref(10);

const fetchData = (newItemsPerPage) => {
    itemsPerPage.value = newItemsPerPage;
    // Fetch data with new items per page
    router.get(route('factories.index'), { per_page: newItemsPerPage }, { preserveState: true, preserveScroll: true });
};

const confirmDeleteEmployee = (employeeId) => {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (!csrfToken) {
                console.error('CSRF token not found.');
                Swal.fire('Error!', 'CSRF token not found. Please check your meta tags.', 'error');
                return;
            }

            axios.delete(route('employee.destroy', employeeId), {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                Swal.fire('Deleted!', 'The employee has been deleted.', 'success');
                router.reload({ preserveState: true, preserveScroll: true });
            })
            .catch(error => {
                console.error('Error deleting employee:', error.response ? error.response.data : error.message);
                Swal.fire('Error!', 'An error occurred while deleting the employee.', 'error');
            });
        }
    });
};
</script>
