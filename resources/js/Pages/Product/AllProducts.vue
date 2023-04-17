<template>
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">All Products</h2>

   <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4 ">
    <div class="md:col-span-8 ">
      <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 ">
      <!-- <div class="min-w-0 flex-1"> -->
    <Box>
        <div class="grid grid-cols-3 divide-x">
        <div>
          <h3 class="text-base font-semibold leading-6 text-gray-900">Product Name</h3>
        </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Price</h3>
      </div>

        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Checkout Page</h3>
        </div>
      </div>
    </Box>
      <Box v-for="product in products" :key="product.id">
        <div class="grid grid-cols-3 divide-x">
          <div>{{product.name}}
            <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ product.description }}</p>
        </div>
        <div class="text-center">
           {{ product.price }} 
        </div>
        <div class="text-center">
           {{ product.checkout_page }} 
        </div>
       
      </div>

        </Box>
      </div>
     </div>
     <div class="md:col-span-4 flex flex-col gap-4">
      <Box>
        <CreateProduct />
       </Box>

     </div>

   </div>
  

</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import CreateProduct from '@/Pages/Product/Create.vue'

const props = defineProps({
  products: Array,
})

</script>