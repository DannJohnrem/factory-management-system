<template>

    <Head title="Employee Create" />

    <AuthenticatedLayout>
        <template #header>Employee Create</template>
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
        <div class="p-4 bg-white rounded shadow-sm dark:bg-gray-800">

            <form @submit.prevent="submitEmployee">
                <div>
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
                        <option v-for="factory in factories" :key="factory.id" :value="factory.id">
                            {{ factory.factory_name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.factory_id" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Create
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Swal from 'sweetalert2';

const { props } = usePage();
const factories = props.factories.data;

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    factory_id: '',
});

const submitEmployee = () => {
    form.post(route('employee.store'), {
        onSuccess: (response) => {
            Swal.fire({
                title: 'Success!',
                text: 'Employee has been created successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            })
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

<style lang="scss">
.dark {
    .multiselect__tags {
        background-color: rgb(55 65 81 / var(--tw-bg-opacity));
        --tw-border-opacity: 1;
        border-color: rgb(75 85 99 / var(--tw-border-opacity));

        span {
            --tw-text-opacity: 1;
            color: rgb(209 213 219 / var(--tw-text-opacity));
        }

        .multiselect__input {
            background-color: rgb(55 65 81 / var(--tw-bg-opacity));
            --tw-border-opacity: 1;
            border-color: rgb(75 85 99 / var(--tw-border-opacity));

            &::placeholder {
                --tw-text-opacity: 1;
                color: rgb(209 213 219 / var(--tw-text-opacity));
            }
        }
    }

    .multiselect__content-wrapper {
        background-color: rgb(55 65 81 / var(--tw-bg-opacity));
        --tw-border-opacity: 1;
        border-color: light-dark(rgb(118, 118, 118), rgb(195, 195, 195));

        .multiselect__content {
            .multiselect__element {
                .multiselect__option {
                    --tw-border-opacity: 1;
                    color: rgb(209 213 219 / var(--tw-bg-opacity));

                    &.multiselect__option--selected {
                        background: light-dark(rgb(118, 118, 118), rgb(195, 195, 195));
                        color: light-dark(rgb(255, 255, 255), rgb(16, 16, 16));

                        &.multiselect__option--highlight {
                            background: #ff6a6a;
                            color: #fff;
                        }
                    }

                }
            }
        }
    }
}
</style>
