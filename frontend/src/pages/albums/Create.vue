<template>

    <q-dialog v-model="isOpen" persistent>
        <q-card :style="$q.platform.is.mobile ? 'min-width: 300px' : 'min-width: 600px'">
            <q-form
                @submit.prevent="onSubmit"
                ref="form"
            >
                <q-card-section>
                    <div class="text-h6">Add Albums</div>
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

export default {
    data() {
        return {
            isOpen: false,
            users: [],
            album: {
                title: '',
                user_id: ''
            }
        }
    },

    methods: {
        show() {
            this.isOpen = true
        },
        onSubmit() {
            api.post(`/api/albums`, this.album)
                .then(({data}) => {
                    this.$q.notify({
                        type: 'positive',
                        message: 'User Created!',
                        position: 'bottom'
                    })

                    this.resetForm()

                    this.isOpen = false

                    this.$emit('albumCreated');

                });
        },
        resetForm() {
            this.user = {
                title: '',
                user_id: ''
            }
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
        this.getUsers()
    }



}
</script>

