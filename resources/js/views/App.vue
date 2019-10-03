<template>
  <div class="max-w-6xl mx-auto">
    <div class="flex justify-between">
      <h1 class="text-4xl">Adudi</h1>
      <div class="flex items-center">
        <router-link class="text-gray-700 hover:text-gray-500" :to="{ name: 'schedule' }">Schedule</router-link>
        <a class="text-gray-700 hover:text-gray-500 ml-4" @click="logout">Logout</a>
      </div>
    </div>
    <div class="mt-8">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
  export default {
    methods: {
      logout() {
        axios.post('/logout')
          .then(response => {
            this.$router.push({ name: 'home' })
          })
      }
    }
  }
</script>