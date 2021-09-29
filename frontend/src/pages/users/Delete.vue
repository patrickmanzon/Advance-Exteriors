<template>
  <q-dialog v-model="confirm" persistent>
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar icon="warning" color="warning" text-color="white" />
          <span class="q-ml-sm">Are you sure you want to delete this user?</span>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancel" color="primary" v-close-popup />
          <q-btn flat label="confirm" color="primary" @click="deleteUser" />
        </q-card-actions>
      </q-card>
    </q-dialog>
</template>

<script>
import { api } from 'boot/axios'

export default {
    data() {
        return {
            confirm: false,
            user: null
        }
    },
    methods: {
        show(user){
            this.user = user
            this.confirm = true
        },
        deleteUser() {
            api.delete(`api/users/${this.user.id}`)
                .then(() => {
                    this.$q.notify({
                        type: 'positive',
                        message: 'User Deleted!',
                        position: 'bottom'
                    })


                    this.confirm = false

                    this.$emit('userDeleted');
                })
        }
    }

}
</script>

<style>

</style>