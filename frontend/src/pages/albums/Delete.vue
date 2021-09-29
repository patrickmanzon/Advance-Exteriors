<template>
  <q-dialog v-model="confirm" persistent>
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar icon="warning" color="warning" text-color="white" />
          <span class="q-ml-sm">Are you sure you want to delete this Album?</span>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancel" color="primary" v-close-popup />
          <q-btn flat label="confirm" color="primary" @click="deleteAlbum" />
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
            album: null
        }
    },
    methods: {
        show(album){
            this.album = album
            this.confirm = true
        },
        deleteAlbum() {
            api.delete(`api/albums/${this.album.id}`)
                .then(() => {
                    this.$q.notify({
                        type: 'positive',
                        message: 'Album Deleted!',
                        position: 'bottom'
                    })


                    this.confirm = false

                    this.$emit('albumDeleted');
                })
        }
    }

}
</script>

<style>

</style>