<template>
    <div>
      <button @click="login">Login</button>
    </div>
  </template>
  
  <script>
  import { getCurrentInstance } from 'vue';
  
  export default {
    setup() {
      const { $inertia } = getCurrentInstance().appContext.config.globalProperties;
  
      const login = () => {
        window.location.href = '/saml2/test/login';

      }
  
      return {
        login,
      }
    },
  }
  </script>
  