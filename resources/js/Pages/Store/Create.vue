<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import StoreForm from "@/Pages/Store/Partials/StoreForm.vue";

const form = useForm({
    name: '',
    description: '',
});
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create a Store</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <StoreForm :form="form" @save="form.post(route('store.store'))" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
