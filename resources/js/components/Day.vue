<template>
  <div v-if="tasks" @click="visible = true" class="flex flex-col justify-between border rounded hover:shadow cursor-pointer w-32 h-32 m-2 p-2 relative"
    :class="{'border-2 border-blue-500': isCurrentDay}">
    <span class="w-6 h-6 flex justify-center itens-center rounded-full text-xs leading-loose" 
      :class="{'bg-blue-500 text-white': isCurrentDay}">
      {{ dayWithZero(day) }}
    </span>
    <div class="absolute flex h-full items-center justify-center left-0 top-0 w-full">
      <svg v-if="list.length === 0" class="h-6" viewBox="-11 0 470 470.001" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="a"><stop offset=".322" stop-color="#a163f5"/><stop offset=".466" stop-color="#b074ee"/><stop offset=".752" stop-color="#d8a1dd"/><stop offset=".898" stop-color="#efbad3"/></linearGradient><linearGradient id="b" gradientTransform="matrix(1 0 0 -1 -32.1 493)" gradientUnits="userSpaceOnUse" x1="369.8" x2="369.8" xlink:href="#a" y1="18" y2="493.052"/><linearGradient id="c" gradientTransform="matrix(1 0 0 -1 -32.1 493)" gradientUnits="userSpaceOnUse" x1="201.2" x2="201.2" xlink:href="#a" y1="18" y2="493.052"/><linearGradient id="d" gradientTransform="matrix(1 0 0 -1 -32.1 493)" gradientUnits="userSpaceOnUse" x1="170.1" x2="170.1" xlink:href="#a" y1="18" y2="493.052"/><linearGradient id="e" gradientTransform="matrix(1 0 0 -1 -32.1 493)" gradientUnits="userSpaceOnUse" x1="255.9" x2="255.9" xlink:href="#a" y1="18" y2="493.052"/><path d="M390.5 350h-42.8v-42.8c0-5.524-4.477-10-10-10-5.524 0-10 4.476-10 10V350h-42.802c-5.52 0-10 4.477-10 10s4.48 10 10 10H327.7v42.8c0 5.524 4.477 10 10 10 5.524 0 10-4.476 10-10V370H390.5c5.523 0 10-4.477 10-10s-4.477-10-10-10zm0 0" fill="url(#b)"/><path d="M246.602 209.102h-155c-5.524 0-10 4.476-10 10 0 5.52 4.476 10 10 10h155c5.523 0 10-4.48 10-10 0-5.524-4.477-10-10-10zm0 0" fill="url(#c)"/><path d="M184.398 274.102H91.602c-5.524 0-10 4.476-10 10 0 5.52 4.476 10 10 10h92.796c5.524 0 10-4.48 10-10 0-5.524-4.476-10-10-10zm0 0" fill="url(#d)"/><path d="M358 251.898V79.102c-.008-27.614-22.39-49.993-50-50h-41V10c0-5.523-4.477-10-10-10s-10 4.477-10 10v19.102H111V10c0-5.523-4.477-10-10-10S91 4.477 91 10v19.102H50c-27.61.007-49.988 22.386-50 50V350c.012 27.61 22.39 49.988 50 50h185.102c19.242 49.281 70.84 77.887 122.832 68.102 51.992-9.786 89.66-55.196 89.668-108.102.097-53.7-38.602-98.5-89.602-108.102zM20.102 79.102c.046-16.551 13.449-29.954 30-30h41v19.097c0 5.524 4.476 10 10 10 5.523 0 10-4.476 10-10V49.102h136v19.097c0 5.524 4.476 10 10 10 5.523 0 10-4.476 10-10V49.102h41c16.546.046 29.949 13.449 30 30V103.3h-318zM229.5 380H50.102c-16.551-.047-29.954-13.453-30-30V123.2H338V250h-.3a110.164 110.164 0 0 0-108.2 130zm108.2 70c-49.704 0-90-40.293-90-90s40.296-90 90-90c49.706 0 90 40.293 90 90-.075 49.676-40.325 89.926-90 90zm0 0" fill="url(#e)"/></svg>
      <a-progress v-else type="circle" :strokeWidth="10" :percent="percentage()" :width="60" :format="percent => percent === 100 ? 'Done' : `${percent}%`" />
    </div>
    <a-drawer
      title="Daily Tasks"
      placement="right"
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
  import { findIndex } from 'lodash'
  import { dayWithZero, taskFullDueDate } from '../helpers/date'
  import New from './tasks/New'
  import TaskList from './tasks/List'
  import Progress from 'ant-design-vue/lib/progress'
  import 'ant-design-vue/lib/progress/style/css'
  import Drawer from 'ant-design-vue/lib/drawer'
  import 'ant-design-vue/lib/drawer/style/css'

  export default {
    components: {
      TaskList,
      New,
      'a-progress': Progress,
      'a-drawer': Drawer,
    },
    props: ['day', 'tasks'],
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