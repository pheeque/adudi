<template>
  <div>
    <a-checkbox :checked="data.status === 1">{{ data.name }}</a-checkbox>
  </div>
</template>

<script>
  import Checkbox from 'ant-design-vue/lib/checkbox'
  import 'ant-design-vue/lib/checkbox/style/css'

  export default {
    components: {
      'a-checkbox': Checkbox,
    },
    props: ['data'],
    data() {
      return {
        
      }
    },

    methods: {
      
    },
  }
</script>