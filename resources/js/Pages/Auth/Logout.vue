<template>
    <div>
       
      <button @click="logout" class="btn-outline font-medium">Logout</button>
    </div>
  </template>
  
  <script>
  import { getCurrentInstance } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3'
  
  export default {
    setup() {
      const { $inertia } = getCurrentInstance().appContext.config.globalProperties;
      const logout = () => {
        window.location.href = '/logout';

      }
  
      return {
        logout,
        Link,
      }
    },
  }
  </script>
  