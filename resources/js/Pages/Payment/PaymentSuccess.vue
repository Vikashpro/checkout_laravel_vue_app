<template>
    <Box>
        <p v-if="props.payment_method=='card'">Thank you, shortly you will receive an email with course login details. You can download your invoice here! </p>
        <p v-if="props.payment_method==null">Thank you, You can download your invoice here! </p>

        <button @click="generate_invoice()" class=" mt-4 btn-primary">Download Invoice</button>
    </Box>
    <div>
        <iframe :src="pdfData" width="100%" height="1200"></iframe>
  </div>
</template>
<script setup>
import Box from '@/Components/UI/Box.vue'
import axios from 'axios';
import { ref, onMounted} from 'vue';
const props = defineProps({
  invoice_id: Number,
  payment_method: String,
})
const pdfData = ref('')
const generate_invoice = () =>{
  axios.post('/generate_invoice', { invoice_id: props.invoice_id }, { responseType: 'blob' })
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
const print_invoice = () =>{

axios.get('/show_invoice/'+props.invoice_id, { responseType: 'blob' })
      .then(response => {
        const reader = new FileReader();
        reader.onload = () => {
          pdfData.value = reader.result;
        };
        reader.readAsDataURL(response.data);
      });
  
}
onMounted(() => {
print_invoice()
    window.sessionStorage.clear()
 })
</script>