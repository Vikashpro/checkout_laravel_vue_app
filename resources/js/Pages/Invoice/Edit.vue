<template>
    <form @submit.prevent="create">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">Personal Information</h2>
      <div class="grid grid-cols-6 gap-4">
        
        <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Full Name</label>
        <input v-model="form.client_name" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.client_name" class="input-error">
          {{ form.errors.client_name }}
        </div>
      </div>
      <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Company</label>
        <input v-model="form.company" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
      </div>
      <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Address</label>
        <input v-model="form.address" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
      </div>
      <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">email</label>
        <input v-model="form.email" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.email" class="input-error">
          {{ form.errors.email }}
        </div>
      </div>
      <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Phone</label>
        <input v-model="form.phone" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.phone" class="input-error">
          {{ form.errors.phone }}
        </div>
       
      </div>
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Create</button>
      </div>
      </div>
    </form>
  </template>
    <script setup>
   
import { useForm} from '@inertiajs/inertia-vue3'
import { reactive } from 'vue'
  const props = defineProps({
    totalNumber: Number,
  })

  const personalInfo = reactive({})

    const form = useForm({
     client_name: personalInfo.client_name,
      company:null,
      phone:null,
      email: null,
      address: null,

    })
    onMounted(() => {
       const lead = JSON.parse(window.sessionStorage.getItem("invoice"));
     
      if (lead) {
        Object.assign(personalInfo, lead);
      }
})
</script>