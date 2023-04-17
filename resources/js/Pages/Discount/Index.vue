<template>
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">All Discounts</h2>

   <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4 ">
    <div class="md:col-span-8 ">
      <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 ">
      <!-- <div class="min-w-0 flex-1"> -->
    <Box>
        <div class="grid grid-cols-4 divide-x">
        <div>
          <h3 class="text-base font-semibold leading-6 text-gray-900">Coupon </h3>
        </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Discount</h3>
      </div>

        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Type</h3>
        </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Validity</h3>
        </div>
      </div>
    </Box>
      <Box v-for="discount in props.discounts" :key="discount.id">
        <div class="grid grid-cols-4 divide-x">
          <div>{{discount.coupon}}
        </div>
        <div class="text-center">
           {{ discount.discount }} 
        </div>
        <div class="text-center">
           {{ discount.type }} 
        </div>
        <div class="text-center">
           {{ discount.validity }} 
        </div>
      </div>

        </Box>
      </div>
     </div>
     <div class="md:col-span-4 flex flex-col gap-4">
      <Box>
        <Create />
       </Box>

     </div>

   </div>
  

</template>
<script setup>
import Box from '@/Components/UI/Box.vue'
import Create from '@/Pages/Discount/Create.vue'

const props = defineProps({
  discounts: Array,
})

</script>