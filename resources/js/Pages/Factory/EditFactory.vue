<template>

    <Head title="Factory Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Factory Edit</h2>
        </template>
        <template #link>
            <Link :href="route('factories.index')"
                class="flex items-center justify-center gap-2 px-3 py-2 font-semibold text-white bg-indigo-500 rounded hover:bg-indigo-700">
            <span>Go back</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>

            </Link>
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <form @submit.prevent="submitUpdateFactory">
                <div class="mt-4">
                    <InputLabel for="factory_name" value="Factory Name" />
                    <TextInput id="factory_name" type="text" class="block w-full mt-1" v-model="form.factory_name" required
                        autofocus autocomplete="factory_name" />
                    <InputError class="mt-2" :message="form.errors.factory_name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="location" value="Location" />
                    <TextInput id="location" type="text" class="block w-full mt-1" v-model="form.location" required
                        autocomplete="location" />
                    <InputError class="mt-2" :message="form.errors.location" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email"
                        required autocomplete="email" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="website" value="Website" />
                    <TextInput id="website" type="text" class="block w-full mt-1" v-model="form.website"
                        required autocomplete="website" />
                    <InputError class="mt-2" :message="form.errors.website" />
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

const props = defineProps({
    factories: {
        type: Object,
        required: true
    }
});

const form = useForm({
    factory_name: props.factories.data.factory_name,
    location: props.factories.data.location,
    email: props.factories.data.email,
    website: props.factories.data.website
});

const submitUpdateFactory = () => {
    form.patch(route('factories.update', props.factories.data.id), {
        onSuccess: (response) => {
            Swal.fire({
                title: 'Success!',
                text: 'Factory has been Updated successfully.',
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
