<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import {ref} from "vue";
import DeleteStores from "@/Pages/Store/Partials/DeleteStores.vue";

const props = defineProps({
  stores: {
    type: Object,
  },
});

const selectedStores = ref([]);
const selectAll = ref(false);

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedStores.value = props.stores.data.map((store) => store);
  } else {
    selectedStores.value = [];
  }
};

const toggleSelectStore = (store) => {
  if (selectedStores.value.find(s => s.id === store.id)) {
    selectedStores.value = selectedStores.value.filter((s) => s.id !== store.id);
  } else {
    selectedStores.value.push(store);
  }
};

const trimString = (string) => {
    if (string.length <= 255) {
        return string; // No need to trim, return the original string
    } else {
        return string.slice(0, 100) + "..."; // Trim the string to 97 characters and add ellipsis
    }
}

const clearDeleteData = () => {
    selectedStores.value = []
    selectAll.value = false;
}

</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-if="$page.props.flash.message"
             class="text-green-500 border border-green-500 p-4 rounded-md shadow-md mb-6">
          {{ $page.props.flash.message }}
        </div>

        <div class="p-6 bg-white overflow-hidden sm:rounded-lg">
          <div class="flex items-center justify-end">
            <DeleteStores @close="clearDeleteData" v-if="selectedStores.length" :stores="selectedStores"/>
            <Link
                class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150-4"
                :href="route('store.create')"
            >
              Create a Store
            </Link>
          </div>
          <div class="relative overflow-x-auto sm:rounded-lg">
            <table v-if="stores.data.length" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead
                  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="p-4">
                  <div class="flex items-center">
                    <input
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        id="checkbox-delete-all"
                        type="checkbox"
                        v-model="selectAll"
                        :checked="selectAll"
                        @change="toggleSelectAll"
                    >
                    <label for="checkbox-delete-all" class="sr-only">checkbox</label>
                  </div>
                </th>
                <th scope="col" class="px-6 py-3">
                  Store name
                </th>
                <th scope="col" class="px-6 py-3">
                  Description
                </th>
                <th scope="col" class="px-6 py-3">
                  <span class="sr-only">View</span>
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
              </thead>
              <tbody>
              <tr
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                  v-for="store in stores.data"
                  :key="store.id"
              >
                <td class="w-4 p-4">
                  <div class="flex items-center">
                    <input
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        :id="`checkbox-delete-${store.id}`"
                        :value="store"
                        type="checkbox"
                        :checked="selectedStores.find(s => s.id === store.id)"
                        @change="toggleSelectStore(store)"
                    >
                    <label :for="`checkbox-delete-${store.id}`" class="sr-only">checkbox</label>
                  </div>
                </td>
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  {{ store.name }}
                </th>
                <td class="px-6 py-4">
                  {{ trimString(store.description) }}
                </td>
                <td class="px-6 py-4 text-right">
                  <Link
                      :href="route('store.show', store)"
                      class="mx-6 font-medium text-blue-600 dark:text-blue-500 hover:underline"
                  >
                    View
                  </Link>
                  <Link
                      :href="route('store.edit', store)"
                      class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-4"
                  >
                    Edit
                  </Link>
                </td>
              </tr>
              </tbody>
            </table>

            <p class="text-center" v-else>No Stores Created Yet</p>

            <Pagination class="mt-6" :links="stores.links"/>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
