<template>
  <div 
    v-if="tasks" 
    @click="visible = true" 
    :style="{'grid-column': day === 1 ? startDay + 1 : ''}"
    class="flex flex-col justify-between h-24 cursor-pointer py-2 relative">
    <span class="w-6 h-6 flex justify-center itens-center rounded-full text-xs leading-loose" 
      :class="{'bg-acyan text-white': isCurrentDay}">
      {{ dayWithZero(day) }}
    </span>
    <div class="absolute flex h-full items-center justify-center left-0 top-0 w-full">
      <svg v-if="percentage() === 100" class="h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 415.998 415.998"><circle cx="208.239" cy="48" r="12"/><path d="M367.998 95.999c0-17.673-14.326-32-31.999-32h-44.424c-5.926-6.583-13.538-11.62-22.284-14.136-7.367-2.118-13.037-7.788-15.156-15.155C248.37 14.663 229.897 0 207.998 0c-21.898 0-40.37 14.663-46.134 34.706-2.122 7.376-7.806 13.039-15.182 15.164-8.736 2.518-16.341 7.55-22.262 14.129H79.999c-17.674 0-32 14.327-32 32v287.999c0 17.673 14.326 32 32 32h256c17.674 0 32-14.327 32-32l-.001-287.999zM128 95.742c.11-14.066 9.614-26.606 23.112-30.496 12.71-3.662 22.477-13.426 26.127-26.116C181.157 25.51 193.805 16 207.998 16c14.194 0 26.842 9.51 30.758 23.13 3.652 12.698 13.413 22.459 26.111 26.11 13.618 3.917 23.13 16.566 23.13 30.758v16H128V95.742zm207.999 304.256h-256c-8.823 0-16-7.178-16-16V95.999c0-8.822 7.177-16 16-16h34.742a47.85 47.85 0 0 0-2.74 15.617v32.383h191.998v-32c0-5.615-.992-10.991-2.764-16h34.764c8.822 0 15.999 7.178 15.999 16 0 45.743-.001 260.254.002 287.999-.001 8.822-7.178 16-16.001 16z"/><path d="M274.51 194.508l-96.167 96.166-42.388-42.388-11.313 11.314 53.701 53.702 107.48-107.48z"/></svg>
      <span v-else>
        <svg v-if="list.length === 0" class="h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><path d="M12.5 24h25a1 1 0 0 0 0-2h-25a1 1 0 0 0 0 2zM12.5 16h10a1 1 0 0 0 0-2h-10a1 1 0 0 0 0 2zM12.5 32h25a1 1 0 0 0 0-2h-25a1 1 0 0 0 0 2zM29.5 38h-17a1 1 0 0 0 0 2h17a1 1 0 0 0 0-2zM26.5 46h-14a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2z"/><path d="M48.5 34.363V14.586L33.914 0H1.5v60h44c7.168 0 13-5.832 13-13 0-6.134-4.276-11.277-10-12.637zm-14-30.949L45.086 14H34.5V3.414zM38.578 58H3.5V2h29v14h14v18.044a11.818 11.818 0 0 0-1-.044c-7.168 0-13 5.832-13 13a13.233 13.233 0 0 0 .087 1.455c.043.382.098.76.173 1.131.009.044.021.087.03.131.072.338.159.67.257.998.025.082.048.165.074.246.113.352.239.698.38 1.037.027.064.057.126.084.189.129.296.269.585.419.869.036.068.07.137.107.205.175.317.363.626.564.927.046.069.094.135.141.203.183.264.375.521.576.77.038.047.074.096.113.143.231.278.475.544.728.801.062.063.125.124.189.186.245.239.496.471.759.69.023.02.045.041.069.06a13.226 13.226 0 0 0 1.1.807c.077.049.151.103.228.152zm6.922 0c-6.065 0-11-4.935-11-11s4.935-11 11-11c.312 0 .62.021.926.047.291.028.592.066.909.119l.443.074C52.753 37.293 56.5 41.716 56.5 47c0 6.065-4.935 11-11 11z"/><path d="M51.5 46h-5v-5a1 1 0 0 0-2 0v5h-5a1 1 0 0 0 0 2h5v5a1 1 0 0 0 2 0v-5h5a1 1 0 0 0 0-2z"/></svg>
        <a-progress v-else type="circle" :strokeColor="progressColor" :strokeWidth="10" :percent="percentage()" :width="40" :format="percent => percent === 100 ? 'Done' : `${percent}%`" />
      </span>
    </div>
    <a-drawer
      title="Daily Tasks"
      placement="left"
      :closable="false"
      @close="visible = false"
      :width="320"
      :visible="visible"
    >
      <TaskList :data="list" />
      <br>
      <div>
        <a-button v-if="!open" type="primary" @click.prevent="open = true">
          <a-icon type="plus" /> New Task
        </a-button>
        <new v-if="open" :day="day" />
      </div>
    </a-drawer>
  </div>
</template>

<script>
  import api from '../api/schedule'
  import Bus from '../bus'
  import New from './tasks/New'
  import TaskList from './tasks/List'
  import Drawer from 'ant-design-vue/lib/drawer'
  import 'ant-design-vue/lib/drawer/style/css'
  import { findIndex } from 'lodash'
  import { dayWithZero, taskFullDueDate } from '../helpers/date'

  export default {
    components: {
      TaskList,
      New,
      'a-drawer': Drawer,
    },
    props: ['day', 'tasks', 'startDay'],
    computed: {
      isCurrentDay() {
        return this.currentDay === this.day
      },
      passedDay() {
        return this.day < this.currentDay
      },
      currentDay() {
        return new Date().getDate()
      },
      isNextDays() {
        return this.day > this.currentDay
      },
      progressColor() {
        return this.passedDay ? '#cccccc' : '#bbded6'
      },
    },
    data() {
      return {
        visible: false,
        open: false,
        list: []
      }
    },
    mounted() {
      this.listen()
      this.listOfDay()
      Bus.$on('complete', payload => {
        let index = findIndex(this.list, item => item.id === payload.id)
        if (index !== -1 && new Date(payload.due_date).getDate() === this.day) {
          this.list.splice(index, 1, Object.assign({}, payload, {
            status: 1
          }))
        }
      })
      Bus.$on('uncomplete', payload => {
        let index = findIndex(this.list, item => item.id === payload.id)
        if (index !== -1 && new Date(payload.due_date).getDate() === this.day) {
          this.list.splice(index, 1, Object.assign({}, payload, {
            status: 0
          }))
        }
      })
      Bus.$on('task-deleted', payload => {
        if (new Date(payload.due_date).getDate() === this.day) {
          this.list = this.list.filter(item => item.id !== payload.id)
        }
      })
    },
    methods: {
      dayWithZero,
      listOfDay() {
        this.list = Object.assign([], this.tasks.filter(task => this.day === new Date(task.due_date).getDate()))
      },
      listen() {
        Echo.channel(taskFullDueDate(this.day))
          .listen('Tasks.TaskCreated', response => {
            this.list = this.list.concat([response.task])
          })
      },
      percentage() {
        return Math.round(this.completed() / this.list.length * 100)
      },
      completed() {
        return this.list.filter(item => item.status === 1).length
      },
    },
  }
</script>