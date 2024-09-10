<template>

    <Head title="Employee Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Employee Edit</h2>
        </template>
        <template #link>
            <Link :href="route('employee.index')"
                class="flex items-center justify-center gap-2 px-3 py-2 font-semibold text-white bg-indigo-500 rounded hover:bg-indigo-700">
            <span>Go back</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>

            </Link>
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <form @submit.prevent="submitUpdateEmployee">
                <div class="mt-4">
                    <InputLabel for="first_name" value="First Name" />
                    <TextInput id="first_name" type="text" class="block w-full mt-1" v-model="form.first_name" required
                        autofocus autocomplete="first_name" />
                    <InputError class="mt-2" :message="form.errors.first_name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="last_name" value="Last Name" />
                    <TextInput id="last_name" type="text" class="block w-full mt-1" v-model="form.last_name" required
                        autocomplete="last_name" />
                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email"
                        required autocomplete="email" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="phone" value="Phone" />
                    <TextInput id="phone" type="text" class="block w-full mt-1" v-model="form.phone"
                        required autocomplete="phone" />
                    <InputError class="mt-2" :message="form.errors.phone" />
                </div>
                <div class="mt-4">
                    <InputLabel for="factory_id" value="Factory" />
                    <select id="factory_id" v-model="form.factory_id" class="block w-full mt-1 form-control" required>
                        <option value="">Select a factory</option>
                        <option v-for="factory in factories.data" :key="factory.id" :value="factory.id">
                            {{ factory.factory_name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.factory_id" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Swal from 'sweetalert2';
import { onMounted } from 'vue';

const props = defineProps({
    employees: {
        type: Object,
        required: true
    },
    factories: {
        type: Array, // Ensure factories is an array
        required: true
    }
});

const form = useForm({
    first_name: props.employees.data.first_name,
    last_name: props.employees.data.last_name,
    email: props.employees.data.email,
    phone: props.employees.data.phone,
    factory_id: props.employees.data.factory_id
});

const submitUpdateEmployee = () => {
    form.patch(route('employee.update', props.employees.data.id), {
        onSuccess: (response) => {
            Swal.fire({
                title: 'Success!',
                text: 'Employee has been Updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        },
        onError: (errors) => {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please check the input fields.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            console.error('Validation error:', errors);
        }
    });
};

</script>
