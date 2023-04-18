<template>
  <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">Choose Products</h2>

 <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4 ">
  <div class="md:col-span-9 ">
    <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 ">
    <!-- <div class="min-w-0 flex-1"> -->
  <Box>
      <div class="grid grid-cols-4 divide-x">
      <div>
        <h3 class="text-base font-semibold leading-6 text-gray-900">Product Name</h3>
      </div>
      <div class="text-center">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Price</h3>
    </div>
      <div class="text-center">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Quantity</h3>
    </div>

      <div class="text-center">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Total amount</h3>
      </div>
    </div>
  </Box>
    <Box v-for="(product, index) in products" :key="product.id">
      <div class="grid grid-cols-4 divide-x">
        <div>{{product.name}}
       <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ product.description }}</p>
      </div>
      <div class="text-center mt-3">${{ product.price }}</div>

      <div class="text-right mr-4">
      <span >{{ product.quantity }}</span>
      <div class="inline-flex ml-5">
      <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold  px-4 rounded-l" @click="decreaseQuantity(index)">
          -
      </button>
      <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r" @click="increaseQuantity(index)">
      +
      </button>
      </div>
    </div>

    <div class="text-center mt-3">${{ product.pr }}</div>
      </div>
      </Box>
      <Box>
      <div class="grid grid-cols-4">
      <div>
      </div>
      <div>
      </div>
      <div class="text-right">
        <h3 class="text-base font-semibold leading-6 text-gray-900">SubTotal</h3>
    </div>

      <div class="text-center">
        <h3 class="text-base font-semibold leading-6 text-gray-900">${{ subTotal }}</h3>
      </div>
    </div>
  </Box>
  <Box>
      <div class="grid grid-cols-4 ">
      <div>
      </div>
      <div>
      </div>
      <div class="text-right">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Discount <span v-if="discountType=='percent'">({{ discount }}%)</span></h3>
    </div>

      <div class="text-center">
        <h3 class="text-base font-semibold leading-6 text-gray-900">${{ discountAmount }}</h3>
      </div>
    </div>
  </Box>
  <Box>
      <div class="grid grid-cols-4 ">
      <div>
      </div>
      <div>
      </div>
      <div class="text-right">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Tax ({{ taxRate }}%)</h3>
    </div>

      <div class="text-center">
        <h3 class="text-base font-semibold leading-6 text-gray-900">${{ taxAmount }}</h3>
      </div>
    </div>
  </Box>
  <Box>
      <div class="grid grid-cols-4 ">
      <div>
      </div>
      <div>
      </div>
      <div class="text-right">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Credit Card Surcharge ({{ paymentSurchargeRate }}%)</h3>
    </div>

      <div class="text-center">
        <h3 class="text-base font-semibold leading-6 text-gray-900">${{ paymentSurchargeAmount }}</h3>
      </div>
    </div>
  </Box>
  <Box>
      <div class="grid grid-cols-4 ">
      <div>
      </div>
      <div>
      </div> 
      <div class="text-right">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Total Amount CAD</h3>
    </div>
      <div class="text-center">
        <h3 class="text-base font-semibold leading-6 text-gray-900">${{ totalAmount }}</h3>
      </div>
    </div>
  </Box>
  
    </div>
   </div>
   <div class="md:col-span-3 flex flex-col gap-4">
    <Box>
      <h3 class="text-base font-semibold leading-6 text-gray-900">Payment Method</h3>
      <div class="mt-4 flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
       <input checked id="bordered-radio-1" type="radio" value="card" v-model="paymentMethod" @change="changePaymentMethod" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <label for="bordered-radio-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pay with Credit, Debit</label>
      </div>
    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
  <input   id="bordered-radio-2" type="radio" value="E Transfer" v-model="paymentMethod"  @change="changePaymentMethod" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
  <label for="bordered-radio-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pay With Interac E-Transfer</label>
</div>

      <button @click="showPaymentModal=true" :disabled="parseInt(totalAmount) === 0" class="btn-primary" >Proceed<span v-if="paymentMethod=='card'"> to Payment</span></button>
     </Box>
    <Box>
      <h3 class="text-base font-semibold leading-6 text-gray-900">Apply Coupon</h3>
      <input v-model="coupon" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
      <div v-if="couponError" class="input-error">
        {{ couponError }}
      </div>
      <div v-if="discount>0" class="success">
        Discount Code Applied!
      </div>
      <button @click="applyCoupon()" class=" mt-4 btn-primary">Apply</button>
    </Box>

   </div>

 </div>

   
   

<Teleport to="body">
<!-- use the modal component, pass in the prop -->
<modal :show="showLeadModal" >
  <template #body>
    <InvoiceCreate @hide-lead-modal="hideLeadModal"/>
  </template>
</modal>
</Teleport>

<Teleport to="body">
<!-- use the modal component, pass in the prop -->
<modal :show="showPaymentModal" >
  <template #body>
    <Payment :totalAmount="totalAmount" :paymentMethod="paymentMethod" @hide-payment-modal="hidePaymentModal"/>
  </template>
</modal>
</Teleport>

</template>

 

<script setup>
import Box from '@/Components/UI/Box.vue'
import Modal from '@/Components/UI/Modal.vue'
import InvoiceCreate from '@/Pages/Invoice/Create.vue'
import Payment from '@/Pages/Payment/Payment.vue'

import { ref, reactive, onMounted,  computed} from 'vue';
import axios from 'axios';



const props = defineProps({
products: Array,
})
const invoice = reactive(Object.create(null));
const subTotal = ref(0)
const discount = ref(0)
const discountAmount = ref(0)
const discountType = ref(null)
const couponError = ref(null)
const taxRate = import.meta.env.VITE_MIX_TAX_RATE
const taxAmount = ref(0)
const paymentSurchargeRate = ref(import.meta.env.VITE_MIX_PAYMENT_SURCHARGE_RATE)
const paymentSurchargeAmount = ref(0.00)
const totalAmount = ref(0.00)
const coupon = ref(null)
const paymentMethod = ref('card')
const showLeadModal = ref(false)
const showPaymentModal = ref(false)



const hidePaymentModal = () =>{
showPaymentModal.value = false
}
const hideLeadModal = () =>{
  const lead = JSON.parse(window.sessionStorage.getItem("invoice"));
      if (lead) {
        Object.assign(invoice, lead);
        showLeadModal.value = false

      }
}
const subTotalCompute = computed(() => {
subTotal.value = props.products.reduce((total, product) => total + product.pr, 0)

})

const changePaymentMethod = computed(() => {
if(paymentMethod.value=='card'){
paymentSurchargeRate.value = import.meta.env.VITE_MIX_PAYMENT_SURCHARGE_RATE;


}else{
paymentSurchargeRate.value = 0

}
calculateFuncs.value
})
const discountCompute = computed(() => {
if(discount.value > 0 && discountType.value=="percent"){
  discountAmount.value = subTotal.value*discount.value/100
}else{
  discountAmount.value = discount.value
}
})
const taxCompute = computed(() => {
taxAmount.value = (subTotal.value - discountAmount.value)*taxRate/100
})

const paymentSurchargeCompute = computed(() => {
paymentSurchargeAmount.value = ((subTotal.value - discountAmount.value+ taxAmount.value )*paymentSurchargeRate.value/100).toFixed(2)
})

const totalAmountCompute = computed(() => {

totalAmount.value = (subTotal.value - discountAmount.value +taxAmount.value+parseFloat(paymentSurchargeAmount.value)).toFixed(2)
})

const calculateFuncs = computed(() => {
subTotalCompute.value
discountCompute.value
taxCompute.value
paymentSurchargeCompute.value
totalAmountCompute.value
postInvoiceData()
})


// const applyCoupon = () => Inertia.post("/coupon", {coupon},{ preserveState:true })
const applyCoupon = () => {
const data = {
  coupon:coupon.value
}
axios.post('/coupon',data).then(response => {
    discount.value = response.data.discount
    if(discount.value == 0){
      couponError.value = "Invalid Coupon Code"
      coupon.value = null
    }else{
      couponError.value = null
      discountType.value = response.data.type
      coupon.value = null
    }

    calculateFuncs.value
  });
}

const postProdQuant = (index) => {
//invoiceDetailId, prodId, InvoiceId, Quantity, Price
const data = {
  invoice_id:invoice.id,
  product_id:props.products[index].id,
  quantity:props.products[index].quantity,
  price: props.products[index].pr

}
axios.post('/update_invoice_detail',data).then(response => {
    
});
}
const postInvoiceData = () => {
//invoiceDetailId, prodId, InvoiceId, Quantity, Price


const data = {
  invoice_id:invoice.id,
  subTotal:subTotal.value,
  discount: discountAmount.value,
  taxAmount:taxAmount.value,
  surchargeAmount:paymentSurchargeAmount.value,
  totalAmount:totalAmount.value

}
axios.post('/update_invoice',data).then(response => {
    
});
}


const increaseQuantity = (index) => {
   props.products[index].quantity++
   props.products[index].pr = props.products[index].pr + props.products[index].price
  postProdQuant(index)
calculateFuncs.value

}
const decreaseQuantity = (index) => { 
  if(props.products[index].quantity>0){
    props.products[index].quantity--
  props.products[index].pr = props.products[index].pr - props.products[index].price

  }  
  calculateFuncs.value
postProdQuant(index)
 

  }
  function openLeadDialog() {
    showLeadModal.value = true;
  }
  onMounted(() => {
     const lead = JSON.parse(window.sessionStorage.getItem("invoice"));
    if(lead == null){
      openLeadDialog();
    }
    if (lead) {
      Object.assign(invoice, lead);
    }
})


</script>


