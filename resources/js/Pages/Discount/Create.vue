<template>
<form @submit.prevent="create">
        <h3 class="text-base font-semibold leading-6 mb-4 text-gray-900">Add Discount</h3>
      
        <div class="grid grid-cols-6 gap-4">
        
        <div class="col-span-6">
        <label class="label"> Coupon</label>
        <input v-model="form.coupon" type="text" class="input" />
        <div v-if="form.errors.coupon" class="input-error">
          {{ form.errors.coupon }}
        </div>
      </div>
      <div class="col-span-6">
        <label class="label">Discount</label>
        <input v-model="form.discount" type="text" class="input" />
        <div v-if="form.errors.discount" class="input-error">
          {{ form.errors.discount }}
        </div>
      </div>
     
    <div>
    </div>
      <div class="col-span-6">
        <label class="label">Type</label>
        <select v-model="form.type" class="input">
  <option disabled value="">select type</option>
  <option value="amount">amount</option>
  <option value="percent">percent</option>
</select>
<div v-if="form.errors.type" class="input-error">
          {{ form.errors.type }}
        </div>
     </div>
     <div class="col-span-6">
        <label class="label">Validity</label>
        <Datepicker v-model="form.validity"  class="input" />
        <div v-if="form.errors.validity" class="input-error">
          {{ form.errors.validity }}
        </div>
    </div>
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Save</button>
      </div>
      </div>
    </form>
</template>
<script setup>
import { useForm, } from '@inertiajs/inertia-vue3'
import Datepicker from 'vue3-datepicker'
import { ref } from 'vue'
const props = defineProps({
  product: Object,
})
// const picked = ref(new Date())
const form = useForm({
    coupon: '',
    discount: '',
    type:'',
    validity: null,
})

    const create = () => {
        form.post('/discount',{
        preserveState:true
})
form.reset()
}
</script>
    
 