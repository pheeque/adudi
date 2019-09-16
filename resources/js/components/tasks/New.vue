<template>
  <a-form :form="task" layout="inline" @submit.prevent="handleSubmit">
    <a-form-item>
      <a-input 
        autoFocus 
        placeholder="Task Name" 
        v-decorator="[
          'name',
          {rules: [{ required: true, message: 'Please input your task name' }]}
        ]"/>
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
        task: this.$form.createForm(this),
      }
    },

    methods: {
      handleSubmit() {
        this.task.validateFields((err, values) => {
          if (!err) {
            api.create(Object.assign({}, this.task.getFieldsValue(), {
              due_date: taskFullDueDate(this.day),
              status: false
            }))
              .then(response => {
                this.task.resetFields()
              })
          }
        })
      }
    },
  }
</script>