<template>
  <div>
    <item :data="task" v-for="task in data" :key="task.id" />
  </div>
</template>

<script>
  import Item from './Item'

  export default {
    components: {
      Item,
    },
    props: ['data'],
    data() {
      return {
        visible: false
      }
    },

    methods: {
      
    },
  }
</script>