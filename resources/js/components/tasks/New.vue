<template>
  <a-form layout="inline" @submit.prevent="handleSubmit">
    <a-form-item>
      <a-input autofocus v-model="task.name" placeholder="Task Name" />
    </a-form-item>
    <a-form-item>
      <a-button html-type="submit" type="primary">Add</a-button>
    </a-form-item>
  </a-form>
</template>

<script>
  import api from '../../api/tasks'
  import m from 'moment'

  export default {
    props: ['day'],
    data() {
      return {
        task: {
          name: '',
          due_date: `${new Date().getFullYear()}-${new Date().getMonth() + 1}-${this.day} 00:00:00`,
          status: false
        }
      }
    },

    methods: {
      handleSubmit() {
        api.create(this.task)
          .then(response => {
            console.log(response)
          })
      }
    },
  }
</script>