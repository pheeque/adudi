<template>
  <div class="flex">
    <a-checkbox @change="onChange" :defaultChecked="item.status" />
    <span class="flex-grow">
      <a-form v-if="isEdit" @submit.prevent="update">
        <a-input autoFocus v-model="item.name" />
        <a-button type="primary" html-type="submit">Save</a-button>
        <a-button @click.prevent="close">X</a-button>
      </a-form>
      <span v-else @click.prevent="open">{{ item.name }}</span>
    </span>
    <a-button type="default" @click.prevent="onDelete" icon="delete" />
  </div>
</template>

<script>
  import api from '../../api/tasks'
  import Bus from '../../bus'

  export default {
    props: ['data'],
    created() {
      this.item = Object.assign({}, this.data, {
        status: this.data.status === 1
      })
    },
    data() {
      return {
        item: null,
        isEdit: false
      }
    },
    methods: {
      update() {
        api.update(this.data.id, Object.assign({}, {name: this.item.name}))
          .then(response => {
            this.close()
          })
      },
      open() {
        this.isEdit = true
      },
      close() {
        this.isEdit = false
      },
      onDelete(e) {
        api.delete(this.data.id)
          .then(response => {
            Bus.$emit('task-deleted', this.item)
          })
      },
      onChange(e) {
        if (e.target.checked) {
          api.complete(this.data.id)
            .then(response => {
              Bus.$emit('complete', this.item)
            })
        } else {
          api.uncomplete(this.data.id)
            .then(response => {
              Bus.$emit('uncomplete', this.item)
            })
        }
      }
    },
  }
</script>