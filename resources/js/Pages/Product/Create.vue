<template>
    <form @submit.prevent="create">
        <h3 class="text-base font-semibold leading-6 mb-4 text-gray-900">Add Product</h3>
      
        <div class="grid grid-cols-6 gap-4">
        
        <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Product Name</label>
        <input v-model="form.name" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.name" class="input-error">
          {{ form.errors.name }}
        </div>
      </div>
      <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Description</label>
        <input v-model="form.description" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.description" class="input-error">
          {{ form.errors.description }}
        </div>
      </div>
      <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Price</label>
        <input v-model="form.price" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.price" class="input-error">
          {{ form.errors.price }}
        </div>
    </div>
    <div>
    </div>
      <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Checkout Page</label>
        <select v-model="form.checkout_page" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500">
  <option disabled value="">select checkout page</option>
  <option value="course">course</option>
  <option value="product">product</option>
</select>
     </div>
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Save</button>
      </div>
      </div>
    </form>
  </template>
    <script setup>
    import { useForm, } from '@inertiajs/inertia-vue3'
 
const props = defineProps({
  product: Object,
})
const form = useForm({
    name: '',
    description: '',
    price: '',
    checkout_page: '',
})

    const create = () => {
        form.post('/store_product',{
        preserveState:true
})
form.reset()
}


  

    </script>
    
 