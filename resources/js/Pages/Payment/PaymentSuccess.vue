<template>
    <Box>
        <p v-if="props.payment_method=='card'">Thank you, shortly you will receive an email with course login details. You can download your invoice here! </p>
        <p v-if="props.payment_method==null">Thank you, You can download your invoice here! </p>

        <button @click="generate_invoice()" class=" mt-4 btn-primary">Download Invoice</button>
    </Box>
</template>
<script setup>
import Box from '@/Components/UI/Box.vue'
import axios from 'axios';
import { onMounted} from 'vue';
const props = defineProps({
  invoice_id: Number,
  payment_method: String,
})
const generate_invoice = () =>{


axios.post('/generate_invoice', { invoice_id: props.invoice_id })
        .then(response => {
          // Open the PDF in a new tab
          window.open(response.data.pdfUrl);
        })
        .catch(error => {
          console.error(error);
        });
}

onMounted(() => {
    window.sessionStorage.clear()
 })
</script>