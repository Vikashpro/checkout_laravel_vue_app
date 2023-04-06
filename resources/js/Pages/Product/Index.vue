<template>
    <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 ">
      <!-- <div class="min-w-0 flex-1"> -->
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">Select Course</h2>
    <Box >
        <div>
          <h3 class="text-base font-semibold leading-6 text-gray-900">Course Name</h3>
        </div>
        <div>
        </div>
    </Box>
      <Box v-for="product in products" :key="product.id">
        <div class="grid grid-cols-3 divide-x">
          <div>{{product.name}}
         <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
        </div>
        <div class="center">
          
          <div class="custom-number-input h-10 w-32">
  <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
    <button class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
      <span class="m-auto text-2xl font-thin">−</span>
    </button>
    <input type="number" class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="0"/>

  <button  class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
    <span class="m-auto text-2xl font-thin">+</span>
  </button>
</div>
</div>
</div>

        <div class="text-center mt-3">100$</div>
        </div>
        </Box>
      </div>
  </template>
  
  <script setup>
  import Box from '@/Components/UI/Box.vue'
  defineProps({
      products: Array,
  })
  </script>
  
  <style>
  input[type='number']::-webkit-inner-spin-button,
  input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .custom-number-input input:focus {
    outline: none !important;
  }

  .custom-number-input button:focus {
    outline: none !important;
  }
</style>
  