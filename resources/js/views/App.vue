<template>
  <div class="max-w-6xl mx-auto">
    <h1 class="text-4xl">Adudi</h1>
    <div>
      <router-link class="" :to="{ name: 'schedule' }">Schedule</router-link>
    </div>
    <div class="mt-8">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
  export default {}
</script>