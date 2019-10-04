<template>
  <div>
    <h1 class="text-center uppercase tracking-wide mb-10">Sign-In</h1>
    <form class="max-w-xs mx-auto" @submit.prevent="login">
      <div>
        <div>E-mail</div>
        <input 
          class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-ared" 
          type="email" 
          autoFocus
          v-model="form.email"/>
      </div>
      <div class="mt-4">
        <div>Password</div>        
        <input 
          class="w-full py-2 border-b focus:outline-none focus:border-b-2 focus:border-ared" 
          type="password"
          v-model="form.password"/>
      </div>
      <div class="mt-4 text-right">
        <button 
          class="bg-ayellow text-white rounded px-4 py-2 uppercase tracking-wide font-semibold" 
          type="submit"
          @click.prevent="login">Login</button>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          email: '',
          password: ''
        }
      }
    },

    methods: {
      login() {
        axios.post('/oauth/token', {
          'grant_type': 'password',
          'client_id': 5,
          'client_secret': 'ddva1d0NnMKOPYMLwPkUB4kyvDu2GnzjyLOp5vCL',
          'username': this.form.email,
          'password': this.form.password,
          'scope': '',
        })
          .then(response => {
            localStorage.setItem('oauth', JSON.stringify(response.data))
            setTimeout(() => {
              this.$router.push({ name: 'schedule' })
            }, 1000)
          })
      },
    },
  }
</script>