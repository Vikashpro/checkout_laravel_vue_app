<template>
      <button  @click="$emit('hide-payment-modal')" class="btn-primary mb-4">Back to Edit</button>

  <form id="payment-form">
    
    <!-- <form @submit.prevent="create"> -->

        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">Payment Information</h2>
      <div class="grid grid-cols-6 gap-4">
        
        <div class="col-span-6">
        <label class="label">Full Name</label>
        <input v-model="form.client_name" type="text" class="input" />
        <div v-if="form.errors.client_name" class="input-error">
          {{ form.errors.client_name }}
        </div>
      </div>
      <div class="col-span-6">
        <label class="label">Company</label>
        <input v-model="form.company" type="text" class="input" />
      </div>
      <div class="col-span-6">
        <label class="label">Address</label>
        <input v-model="form.address" type="text" class="input" />
      </div>
        <div class="col-span-3">
        <label class="label">email</label>
        <input v-model="form.email" type="text" class="input" />
        <div v-if="form.errors.email" class="input-error">
          {{ form.errors.email }}
        </div>
        </div>
      <div class="col-span-3">
        <label class="label">Phone</label>
        <input v-model="form.phone" type="text" class="input" />
        <div v-if="form.errors.phone" class="input-error">
          {{ form.errors.phone }}
        </div>
      </div>
      </div>
      <!-- <div class="col-span-6">
        <button type="submit" class="btn-primary">Create</button>
      </div> -->
    <!-- </form> -->
      <div id="payment-element" v-if="props.paymentMethod=='card'">
      
          <!-- Stripe will create form elements here -->
  </div> 
  <div v-if="cardError" class="input-error">
          {{ cardError}}
        </div>


  <button type="submit" @click="handleSubmit" class="btn-primary"><span v-if="props.paymentMethod=='card'">Pay (${{ props.totalAmount }})</span><span v-else>Checkout </span></button>
  </form>
</template>

<script setup>
import { ref, onMounted } from "vue"
import axios from 'axios';
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
   
   const form = useForm({
    client_name: null,
     company:null,
     phone:null,
     email: null,
     address: null,
    payment_status:'Pending',
    payment_method:null,
   })

const token = ref(null)
const stripe = ref(null)
const elements = ref(null)
const clientSec = ref(null)
const cardError = ref(null)

const props = defineProps( {
    totalAmount: Number,
    paymentMethod: String,
    showPaymentModal:Boolean,
  })


onMounted(() => {
  initPayment()
  
})




const initPayment = () => {
  if(props.paymentMethod =='card'){
    axios.post('/payment/initiate', {
      amount: props.totalAmount,
      currency: 'CAD'
  }).then(response => {
      token.value = response.token // Use to identify the payment
      stripe.value = Stripe(import.meta.env.VITE_MIX_STRIPE_PUBLISHABLE_KEY);
      const options = {
          clientSecret: response.client_secret,
      }
      clientSec.value = response.data.client_secret
      elements.value = stripe.value.elements(options);
      const paymentElement = elements.value.create('card');
      paymentElement.mount('#payment-element');
      
  }).catch(error => {
      // throw error
  })
  }
  const lead = JSON.parse(window.sessionStorage.getItem("invoice"));
      if (lead) {
        Object.assign(form, lead);
      }
}


const submitForm = async () => {
  form.payment_method = props.paymentMethod;
  
  try {
    const response = await axios.post('/update_lead', form);
    form.errors = '';
    
    if (response.data.errors) {
      throw new Error('Form submission failed.');
    } 
    
  } catch (error) {
    if (error && error.response) {
      const errors = error.response.data.errors;
      form.errors = Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value.join(' ')]));
    }
    
    throw new Error('Form submission failed.');
  }
}  
const handleSubmit = async (e) => {
  e.preventDefault();
  try {
    await submitForm();
    
    if(props.paymentMethod=='card'){
      const cardElement = elements.value.getElement('card');
    stripe.value.confirmCardPayment(clientSec.value, {
    payment_method: {
      card: cardElement
    },
  })
  .then(function(result) {
    if(result.error){
      cardError.value  = result.error.message;
    }else{
      Inertia.post("/payment/complete", {
            payment_id: result.paymentIntent.id,
            invoice_id: form.id
        })
    }
  });
  }else{
    Inertia.post("/payment/complete", {
            payment_id: null,
            invoice_id: form.id
        })
  }


  } catch (error) {
    console.error(error);
  }




}
</script>

