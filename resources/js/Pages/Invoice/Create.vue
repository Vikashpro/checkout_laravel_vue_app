<template>
    <form @submit.prevent="create">
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
    import {computed,watch } from 'vue'
    import { useForm, usePage } from '@inertiajs/inertia-vue3'
    const props = defineProps({
  invoice: Object,
})
    const form = useForm({
     client_name: null,
      company:null,
      phone:null,
      email: null,
      address: null,

    })
    const page = usePage()
    computed(() =>
        console.log(form)
    )
    //page.props.value.flash.success
    // const create = () => form.post('/invoice')
    const create = async () => {
  await form.post('/invoice')
//   const invoice = page.props.invoice
//   window.sessionStorage.setItem('invoice', JSON.stringify(invoice))
//   console.log(invoice)
saveInvoiceToSession.value


}
const saveInvoiceToSession = computed(() => {

  if (props.invoice) {
    const invoice = props.invoice
    window.sessionStorage.setItem('invoice', JSON.stringify(invoice))
    console.log(invoice.id)
  }
})
watch(() => props.invoice, () => {
    saveInvoiceToSession.value
  })
   

    </script>
    
 