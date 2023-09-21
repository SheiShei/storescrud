<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import {computed, nextTick, ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  stores: {
    type: Array
  }
})

const emit = defineEmits(['close'])

const storeIds = computed(() => {
  return props.stores.map(s => s.id)
})

const form = useForm({
  password: '',
  stores: storeIds.value,
});

const confirmingStoresDeletion = ref(false);
const passwordInput = ref(null);

const confirmStoresDeletion = () => {
  confirmingStoresDeletion.value = true;
  nextTick(resetValues);
};

const resetValues = () => {
    form.password = ''
    passwordInput.value.focus()
}

const closeModal = () => {
  confirmingStoresDeletion.value = false;
  emit('close')
};

const deleteStores = () => {
  form.transform((data) => ({
      ...data,
      stores: storeIds.value,
  })).delete(route('store.bulkDestroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => resetValues(),
    onFinish: () => form.reset(),
  });
};
</script>
<template>
  <DangerButton @click="confirmStoresDeletion">Delete Store/s</DangerButton>
  <Modal :show="confirmingStoresDeletion" @close="closeModal">
    <div class="p-6">
      <h2 class="text-lg font-medium text-gray-900">
        Are you sure you want to delete these store/s?
      </h2>

      <p class="mt-1 text-sm text-gray-600 mb-4">
        Once a store is deleted, all of its data will be permanently deleted. Please
        enter your password to confirm you would like to permanently delete these stores.
      </p>

      <p v-for="store in stores" :key="store.id">- {{ store.name }}</p>

      <div class="mt-6">
        <InputLabel for="password" value="Password" class="sr-only"/>

        <TextInput
            id="password"
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4"
            placeholder="Password"
            @keyup.enter="deleteStores"
        />

        <InputError :message="form.errors.password" class="mt-2"/>
      </div>

      <div class="mt-6 flex justify-end">
        <SecondaryButton @click="closeModal"> Cancel</SecondaryButton>

        <DangerButton
            class="ml-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteStores"
        >
          Delete Stores
        </DangerButton>
      </div>
    </div>
  </Modal>
</template>
