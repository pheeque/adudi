<template>
  <div>
    <h1 class="text-center uppercase tracking-wide mb-10">Sign-In</h1>
    <form class="max-w-xs mx-auto" @submit.prevent="login">
      <div>
        <div>E-mail</div>
        <input class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-ared" type="email" autoFocus />
      </div>
      <div class="mt-4">
        <div>Password</div>        
        <input class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-ared" type="password" />
      </div>
      <div class="mt-4 text-right">
        <button class="bg-ayellow text-white rounded-lg px-4 py-2 uppercase tracking-wide font-semibold" type="submit">Login</button>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        
      }
    },

    methods: {
      login() {
        alert('ok')
      }
    },
  }
</script>