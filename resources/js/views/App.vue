<template>
  <div class="max-w-6xl mx-auto">
    <div class="flex justify-between">
      <h1 class="text-4xl">Adudi</h1>
      <button @click="logout">Logout</button>
    </div>
    <div>
      <router-link class="" :to="{ name: 'schedule' }">Schedule</router-link>
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