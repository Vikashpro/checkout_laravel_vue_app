<template>
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">Invoices</h2>

   <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4 ">
    <div class="md:col-span-12 ">
      <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 ">
      <!-- <div class="min-w-0 flex-1"> -->
    <Box>
        <div class="grid grid-cols-10 divide-x">
        <div class="text-center">
          <h3 class="head3">Invoice No</h3>
        </div>
        <div class="text-center">
          <h3 class="head3">Client Name</h3>
      </div>

        <div class="text-center">
          <h3 class="head3">Sub Total</h3>
        </div>
        <div class="text-center">
          <h3 class="head3">Discount</h3>
        </div>
        <div class="text-center">
          <h3 class="head3">Tax</h3>
      </div>

        <div class="text-center">
          <h3 class="head3">Surcharge Amount</h3>
        </div>
        <div class="text-center">
          <h3 class="head3">Total Amount</h3>
        </div>
        <div class="text-center">
          <h3 class="head3">Payment Method</h3>
      </div>
        <div class="text-center">
          <h3 class="head3">Payment Status</h3>
        </div>
        <div class="text-center">
          <h3 class="head3">Actions</h3>
        </div>
      </div>
    </Box>
      <Box v-for="invoice in invoices" :key="invoice.id">
     <div class="grid grid-cols-10 divide-x">
       <Invoice :invoice="invoice" />
       <div class="text-center">Edit</div>
      </div>

        </Box>
      </div>
      </div>
      </div>
      
  </template>
  
  <script setup>
import Box from '@/Components/UI/Box.vue'
import Invoice from '@/Components/Invoice.vue'

  defineProps({
      invoices: Array,
  })
  </script>
  
  
  