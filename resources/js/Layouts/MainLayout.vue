<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
          Courses
        </div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-4">
    <slot>Default</slot>
  </main>
</template>

<script setup>
</script>
