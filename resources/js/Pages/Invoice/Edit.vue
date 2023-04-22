<template>
  <form @submit.prevent="update">
      <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl mb-6 sm:tracking-tight">Update Invoice # {{ form.id }}</h2>
    <div class="grid grid-cols-9 gap-4">
    
      <div class="col-span-3">
      <label class="label">Client Name</label>
      <input v-model="form.client_name" type="text" class="input" />
      <div v-if="form.errors.client_name" class="input-error">
        {{ form.errors.client_name }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">Company</label>
      <input v-model="form.company" type="text" class="input" />
    </div>
    <div class="col-span-3">
      <label class="label">email</label>
      <input v-model="form.email" type="text" class="input" />
      <div v-if="form.errors.email" class="input-error">
        {{ form.errors.email }}
      </div>
    </div>

    <div class="col-span-6">
      <label class="label">Address</label>
      <input v-model="form.address" type="text" class="input" />
    </div>
    <div class="col-span-3">
      <label class="label">Phone</label>
      <input v-model="form.phone" type="text" class="input" />
      <div v-if="form.errors.phone" class="input-error">
        {{ form.errors.phone }}
      </div>
    </div>
    <div class="col-span-9">
    <span v-for="(invoice_detail, index) in form.invoice_detail" :key="index">
      <div class="grid grid-cols-9 gap-4">
    
      <div class="col-span-3">
    <label class="label">Product Name</label>
    <select v-model="form.invoice_detail[index].product_id" :disabled="form.invoice_detail[index].product!=null" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500">
  <option disabled value="">select checkout page</option>
  <option v-for="product in products" :key="product.id" :value="product.id" >{{ product.name }}</option>

</select>
      <!-- <input v-model="form.invoice_detail[index].product.name" disabled="true" type="text" class="input" /> -->
  </div>
        <div class="col-span-3">
    <label class="label">Quantity</label>
      <input v-model="form.invoice_detail[index].quantity" type="text" class="input" />
  </div>
    <div class="col-span-3">
    <label class="label" >Price</label>
    <div class="flex flex-nowrap">
      <input v-model="form.invoice_detail[index].price" @change="subTotalCompute" type="text" class="input" />
      <button @click="deleteProd(index)" type="button" class="btn-outline  ml-2 font-medium"><font-awesome-icon icon="fa-solid fa-trash" /></button>
      <button class="btn-outline  ml-2 font-medium" v-if="index==form.invoice_detail.length-1" @click="form.invoice_detail.push({})"><font-awesome-icon icon="fa-solid fa-cart-shopping" /></button>
    </div>
  </div>
</div>

</span>
</div>
    <div class="col-span-3">
      <label class="label">Sub Total</label>
      <input v-model="form.sub_total" type="text" class="input" />
      <div v-if="form.errors.sub_total" class="input-error">
        {{ form.errors.sub_total }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">Discount Amount</label>
      <input v-model="form.discount" @change="calculate" type="text" class="input" />
      <div v-if="form.errors.discount" class="input-error">
        {{ form.errors.discount }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">{{ taxName }} ({{ taxRate }}%)</label>
      <input v-model="form.tax" type="text" class="input" />
      <div v-if="form.errors.tax" class="input-error">
        {{ form.errors.tax }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">Payment Card Surcharge ({{ paymentSurchargeRate }}%)</label>
      <input v-model="form.payment_surcharge" type="text" class="input" />
      <div v-if="form.errors.payment_surcharge" class="input-error">
        {{ form.errors.payment_surcharge }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">Total</label>
      <input v-model="form.total" type="text" class="input" />
      <div v-if="form.errors.total" class="input-error">
        {{ form.errors.total }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">Paid Amount</label>
      <input v-model="form.paid_amount" type="text" class="input" />
      <div v-if="form.errors.phone" class="input-error">
        {{ form.errors.phone }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">Payment_method</label>
      <select v-model="form.payment_method" @change="changePaymentMethod" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500">
  <option disabled value="">select payment method</option>
  <option value="card">Card</option>
  <option value="E Transfer">E Transfer</option>
  </select>
    </div>
    <div class="col-span-3">
      <label class="label">Payment ID</label>
      <input v-model="form.payment_id" type="text" class="input" />
    <div v-if="form.errors.payment_id" class="input-error">
        {{ form.errors.payment_id }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">Payment Status</label>
      <select v-model="form.payment_status" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500">
  <option disabled value="">select payment status</option>
  <option value="Paid">Paid</option>
  <option value="Pending">Pending</option>
  </select>
    </div>
    <div class="col-span-6">
      <button type="submit" class="btn-primary">Update</button>
    </div>
    </div>
  </form>
</template>
  <script setup>
 
import { useForm} from '@inertiajs/inertia-vue3'
import { reactive,ref, onMounted, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import axios from 'axios';



const props = defineProps({
  invoice: Object,
})

const taxRate = import.meta.env.VITE_MIX_TAX_RATE
const taxName = import.meta.env.VITE_MIX_TAX_NAME
const paymentSurchargeRate = ref(import.meta.env.VITE_MIX_PAYMENT_SURCHARGE_RATE)
const products = ref([])
const deletedProducts = ref([]);

const deleteProd = (index) => {
  const prod = form.invoice_detail[index];

  if(prod.id != undefined){
   deletedProducts.value.push(prod);
  }
  form.invoice_detail.splice(index, 1)
  subTotalCompute.value
}
  const form = useForm({})
  // const update = () => form.post("/edit_invoice")
  const update = () =>{

      const data = {
        deleteItems: deletedProducts.value,
          invoice:form,
      }
    Inertia.post("/edit_invoice", {
          data
        })
  }
  const subTotalCompute = computed(() => {
  form.sub_total = form.invoice_detail.reduce((total, item) => total + parseFloat(item.price), 0)
  calculate.value
})

const taxCompute = computed(() => {
form.tax = (form.sub_total- form.discount)*taxRate/100
})
const changePaymentMethod = computed(() => {
if(form.payment_method=='card'){
  paymentSurchargeRate.value = import.meta.env.VITE_MIX_PAYMENT_SURCHARGE_RATE
}else{
  paymentSurchargeRate.value = 0.00
}
calculate.value
})
const paymentSurchargeCompute = computed(() => {
    form.payment_surcharge = ((form.sub_total - form.discount+ form.tax )*paymentSurchargeRate.value/100).toFixed(2)
})
const totalAmountCompute = computed(() => {
form.total = (form.sub_total - form.discount +form.tax+parseFloat(form.payment_surcharge)).toFixed(2)
})
const calculate = computed(() => {
  taxCompute.value
  paymentSurchargeCompute.value
  totalAmountCompute.value
})
const getProducts = () => {
  axios.get('/getProducts')
        .then(response => {
          products.value = response.data.products
        })
        .catch(error => {
          console.log(error)
        })

}
  onMounted(() => {
      getProducts()
      Object.assign(form, props.invoice)
      changePaymentMethod.value
    
})
</script>
