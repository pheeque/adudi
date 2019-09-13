<template>
  <a-form layout="inline" @submit.prevent="handleSubmit">
    <a-form-item>
      <a-input autoFocus v-model="task.name" placeholder="Task Name" />
    </a-form-item>
    <a-form-item>
      <a-button html-type="submit" type="primary">Add</a-button>
    </a-form-item>
  </a-form>
</template>

<script>
  import api from '../../api/tasks'
  import { taskFullDueDate } from '../../helpers/date'

  export default {
    props: ['day'],
    data() {
      return {
        task: {
          name: '',
          due_date: taskFullDueDate(this.day),
          status: false
        }
      }
    },

    methods: {
      handleSubmit() {
        api.create(this.task)
          .then(response => {
            // console.log(response)
          })
      }
    },
  }
</script>