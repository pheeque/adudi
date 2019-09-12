<template>
  <div class="flex flex-col justify-between w-32 h-32 m-2 p-2 relative"
    :class="{'bg-red-100': passedDay, 'bg-green-100': isCurrentDay}">
    <span class="w-6 h-6 flex justify-center itens-center rounded-full text-xs leading-loose" 
      :class="{'bg-blue-500 text-white': isCurrentDay}">
      {{ day }}
    </span>
    <a-progress v-if="isCurrentDay || passedDay" type="circle" :percent="30" :width="40" />
  </div>
</template>

<script>
  import Progress from 'ant-design-vue/lib/progress'
  import 'ant-design-vue/lib/progress/style/css'

  export default {
    components: {
      'a-progress': Progress
    },
    props: ['day'],
    computed: {
      isCurrentDay() {
        return this.currentDay === this.day
      },
      passedDay() {
        return this.day < this.currentDay
      },
      currentDay() {
        return new Date().getDate()
      }
    },
    data() {
      return {
        
      }
    },

    methods: {
      
    },
  }
</script>