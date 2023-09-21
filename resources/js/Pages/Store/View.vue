<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';

defineProps({
    store: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Store {{ store.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="$page.props.flash.message" class="text-green-500 border border-green-500 p-4 rounded-md shadow-md mb-6">
                    {{ $page.props.flash.message }}
                </div>

                <div class="p-6 bg-white overflow-hidden sm:rounded-lg">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ store.name }}</h1>
                    <p>{{ store.description }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
