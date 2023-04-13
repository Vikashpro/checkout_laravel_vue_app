<template>
        <div class="text-center">{{ invoice.id}}</div>
        <div class="text-center">{{ invoice.client_name}}</div>
        <div class="text-center">${{ invoice.sub_total}}</div>
        <div class="text-center">${{ invoice.discount}}</div>
        <div class="text-center">${{ invoice.tax}}</div>
        <div class="text-center">${{ invoice.surcharge_amount}}</div>
        <div class="text-center">${{ invoice.total}}</div>
        <div class="text-center">{{ invoice.payment_method}}</div>
        <div class="text-center">{{ invoice.payment_status}}</div>

</template>
<script setup>
const props = defineProps({
    invoice: Object,
  })
</script>