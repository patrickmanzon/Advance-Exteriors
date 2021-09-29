<template>

    <q-dialog v-model="isEdit" persistent>
        <q-card :style="$q.platform.is.mobile ? 'min-width: 300px' : 'min-width: 600px'">
            <q-form
                @submit.prevent="onSubmit"
            >
                <q-card-section>
                    <div class="text-h6">Edit {{ album.title }}</div>
                </q-card-section>

                <div class="q-gutter-md q-px-lg">
                    <div>
                        <q-input outlined v-model="album.title" label="Title" />
                    </div>
                    <div>
                        <q-select outlined v-model="album.user_id" :options="users" option-value="id" emit-value option-label="label" map-options label="User" />
                    </div>
                </div>

                <q-card-actions align="right" class="text-primary">
                    <q-btn flat label="Cancel" v-close-popup />
                    <q-btn flat label="Save" type="submit" />
                </q-card-actions>
            </q-form>
        </q-card>
    </q-dialog>
  
</template>

<script>
import { api } from 'boot/axios'
import { Notify } from 'quasar'

export default {
    data() {
        return {
            isEdit: false,
            users: [],
            album: {
                title: '',
                user_id: ''
            }
        }
    },

    methods: {
        show(album) {
            this.isEdit = true
            this.album = album
        },
        onSubmit() {
            api.put(`/api/albums/${this.album.id}`, this.album)
                .then(({data}) => {
                    this.$q.notify({
                        type: 'positive',
                        message: 'Album Updated!',
                        position: 'bottom'
                    })

                    this.$emit('albumUpdated');
                    
                });
        },
        getUsers() {
            api.get(`/api/users?all=1`)
                .then(({data}) => {
                    this.users = data.users.map(user => {
                        return {
                            label: user.name,
                            id: user.id
                        }
                    });
                });
        }
    },

    created() {
        this.getUsers();
    }



}
</script>

