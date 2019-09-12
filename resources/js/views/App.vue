<template>
  <div class="max-w-6xl mx-auto">
    <h1 class="text-4xl">
      A<span class="text-green-500">d</span><span class="text-orange-500">u</span>d<span class="text-red-500">i</span>
    </h1>
    <p>
      <router-link class="text-blue-500" :to="{ name: 'home' }">Home</router-link> |
      <router-link class="text-blue-500" :to="{ name: 'hello' }">Hello World</router-link> |
      <router-link class="text-blue-500" :to="{ name: 'users.index' }">Users</router-link> |
      <router-link class="text-blue-500" :to="{ name: 'schedule' }">Schedule</router-link>
    </p>

    <div class="mt-8">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
  export default {}
</script>