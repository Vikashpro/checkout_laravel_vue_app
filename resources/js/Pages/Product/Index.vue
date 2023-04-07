<template>
    <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 ">
      <!-- <div class="min-w-0 flex-1"> -->
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">Select Course</h2>
    <Box>
        <div class="grid grid-cols-3 divide-x">
        <div>
          <h3 class="text-base font-semibold leading-6 text-gray-900">Course Name</h3>
        </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">No of Users</h3>
      </div>

        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Price</h3>
        </div>
      </div>
    </Box>
      <Box v-for="product in products" :key="product.id">
        <div class="grid grid-cols-3 divide-x">
          <div>{{product.name}}
         <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
        </div>
        <div class="text-center">
	      <span class="ml-11">2</span>
	      <div class="inline-flex ml-5">
        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold  px-4 rounded-l">
            -
        </button>
        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
        +
        </button>
        </div>
      </div>

        <div class="text-center mt-3">100$</div>
        </div>
        </Box>
        <Box>
        <div class="grid grid-cols-3">
        <div>
          <h3 class="text-base font-semibold leading-6 text-gray-900"></h3>
        </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">SubTotal</h3>
      </div>

        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">500$</h3>
        </div>
      </div>
    </Box>
    <Box>
        <div class="grid grid-cols-3 ">
        <div>
        </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Discount</h3>
      </div>

        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">40$</h3>
        </div>
      </div>
    </Box>
    <Box>
        <div class="grid grid-cols-3 ">
        <div>
        </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Tax</h3>
      </div>

        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">20$</h3>
        </div>
      </div>
    </Box>
    <Box>
        <div class="grid grid-cols-3 ">
        <div>
        </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">Total Amount</h3>
      </div>
        <div class="text-center">
          <h3 class="text-base font-semibold leading-6 text-gray-900">500$</h3>
        </div>
      </div>
    </Box>
    
      </div>
      <div class="">
      <button type="button" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 mr-2 mb-2">
  Pay with Debit Card/Credit Card
</button>
      </div>
    
   
  
  </template>
  
   
  
  <script setup>
import Box from '@/Components/UI/Box.vue'

import { ref, reactive,   computed} from 'vue';
const props = defineProps({
  products: Array,
})
const lead = {};

const isLead = ref(false);

const storeData = () => {
  // sessionStorage.setItem('lead', .value);
  // sessionStorage.setItem('product', JSON.stringify(product.value));
  // name.value = nameInput.value;
  // nameInput.value = '';
};

computed(() => {
  const lead = sessionStorage.getItem('lead');
  console.log("lead");
  if(lead == null){
    console.log("lead isnull")
  }
})



</script>

  
