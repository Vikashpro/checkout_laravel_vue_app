<template>
  <div class="flex gap-8">
    <div class="grow "><h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">Invoices</h2>
    </div>
    <div > <Link :href="'/all_products'" class=" font-medium">Products </Link> </div>
    <div > <Link :href="'/discount'" class=" font-medium">Discount </Link> </div>
    <div > <logout /></div>
  </div>

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
       <section>      
         <div class="flex items-center gap-1  text-gray-600 dark:text-gray-300">
        <Link :href="`/invoice/${invoice.id}`" class="btn-outline  ml-4 font-medium">Edit </Link> 
        <button @click="downloadInvoice(invoice.id)" class="btn-outline  ml-2 font-medium">pdf </button> 
       </div>
       <div class="mt-2 ml-2">
        <button @click="sendInvoiceInEmail(invoice.id)" :disabled="emailDisabled" class="btn-outline  ml-2 font-medium">Send Email </button> 
</div>
</section>

       <!-- <div class="text-center">
        <Link :href="`/invoice/${invoice.id}`" class="btn-outline  font-medium">Edit aldfj  </Link> 
        <button @click="downloadInvoice(invoice.id)" class="btn-outline  ml-2 font-medium">pdf </button> 
       </div> -->
      </div>

        </Box>
      </div>
      </div>
  
      </div>
  </template>
  
  <script setup>
import Box from '@/Components/UI/Box.vue'
import Invoice from '@/Components/Invoice.vue'
import Logout from '@/Pages/Auth/Logout.vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { createToast } from 'mosha-vue-toastify'
import 'mosha-vue-toastify/dist/style.css'
import axios from 'axios';
import {ref} from 'vue'
// const route = useRoute()
  defineProps({
      invoices: Array,
  })

 
const downloadInvoice = (id) => {
  axios.post('/generate_invoice', { invoice_id: id }, { responseType: 'blob' })
    .then(response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'invoice.pdf');
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    })
    .catch(error => {
      console.error(error);
    });
}
const emailDisabled = ref(false)
const sendInvoiceInEmail = (id) => {
  emailDisabled.value = true
  axios.post('/send_email', { invoice_id: id })
    .then(response => {
      createToast(response.data.message)
      emailDisabled.value = false
    })
    .catch(error => {
      console.error(error);
    });
}




  </script>
  
  
  