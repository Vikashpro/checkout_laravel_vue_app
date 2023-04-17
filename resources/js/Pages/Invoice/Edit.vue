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
      <input v-model="form.invoice_detail[index].product.name" disabled="true" type="text" class="input" />
  </div>
        <div class="col-span-3">
    <label class="label">Quantity</label>
      <input v-model="form.invoice_detail[index].quantity" type="text" class="input" />
  </div>
    <div class="col-span-3">
    <label class="label" >Price</label>
      <input v-model="form.invoice_detail[index].price" type="text" class="input" />
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
      <input v-model="form.discount" type="text" class="input" />
      <div v-if="form.errors.discount" class="input-error">
        {{ form.errors.discount }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">tax</label>
      <input v-model="form.tax" type="text" class="input" />
      <div v-if="form.errors.tax" class="input-error">
        {{ form.errors.tax }}
      </div>
    </div>
    <div class="col-span-3">
      <label class="label">Payment Surcharge Amount</label>
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
      <select v-model="form.payment_method" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500">
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
import { reactive, onMounted } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  invoice: Object,
})


  const form = useForm({})
  // const update = () => form.post("/edit_invoice")
  const update = () =>{
      const data = form;
    Inertia.post("/edit_invoice", {
          data
        })
  }


  onMounted(() => {
   
      Object.assign(form, props.invoice);
    
})
</script>