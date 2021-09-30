<template>
  <q-dialog v-model="confirm" persistent>
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar icon="warning" color="warning" text-color="white" />
          <span class="q-ml-sm">Are you sure you want to delete this Photo?</span>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancel" color="primary" v-close-popup />
          <q-btn flat label="confirm" color="primary" @click="deletePhoto" />
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
            photo: null
        }
    },
    methods: {
        show(photo){
            this.photo = photo
            this.confirm = true
        },
        deletePhoto() {
            api.delete(`api/photos/${this.photo.id}`)
                .then(() => {
                    this.$q.notify({
                        type: 'positive',
                        message: 'Photo Deleted!',
                        position: 'bottom'
                    })


                    this.confirm = false

                    this.$emit('photoDeleted');
                })
        }
    }

}
</script>

<style>

</style>