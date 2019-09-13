<template>
  <div>
    <a-checkbox @change="onChange" :defaultChecked="item.status">{{ item.name }}</a-checkbox>
  </div>
</template>

<script>
  import api from '../../api/tasks'
  export default {
    props: ['data'],
    created() {
      this.item = Object.assign({}, this.data, {
        status: this.data.status === 1
      })
    },
    data() {
      return {
        item: null
      }
    },
    methods: {
      onChange(e) {
        if (e.target.checked) {
          api.complete(this.data.id)
            .then(response => {
              //
            })
        } else {
          api.uncomplete(this.data.id)
            .then(response => {
              //
            })
        }
      }
    },
  }
</script>