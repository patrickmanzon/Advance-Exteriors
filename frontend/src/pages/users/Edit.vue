<template>

    <q-dialog v-model="isEdit" persistent>
        <q-card :style="$q.screen.lt.md ? 'min-width: 300px' : 'min-width: 600px'">
            <q-form
                @submit.prevent="onSubmit"
            >
                <q-card-section>
                    <div class="text-h6">Edit {{ user.name }}</div>
                </q-card-section>

                <div class="q-gutter-md q-px-lg">
                    <div>
                        <q-input outlined v-model="user.name" label="Name" />
                    </div>
                    <div>
                        <q-input outlined v-model="user.username" label="Username" />
                    </div>
                    <div>
                        <q-input outlined v-model="user.email" label="Email" />
                    </div>
                    <div>
                        <q-input outlined v-model="user.phone" label="Phone" />
                    </div>
                    <div>
                        <q-input outlined v-model="user.website" label="Website" />
                    </div>
                    <div>
                        <q-select outlined v-model="user.status" :options="options" label="Status" />
                    </div>
                    <div>
                        <q-input outlined v-model="user.company" label="Company" />
                    </div>
                    <div>
                        <q-input outlined v-model="user.password" label="Password" type="password"/>
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
            user: {
                name: '',
                username: '',
                email: '',
                phone: '',
                website: '',
                status: '',
                company: '',
                password: ''   
            },
            options: ['delivered','info','pending','danger']
        }
    },

    methods: {
        show(user) {
            this.isEdit = true
            this.user = user
        },
        onSubmit() {
            api.put(`/api/users/${this.user.id}`, this.user)
                .then(({data}) => {
                    this.$q.notify({
                        type: 'positive',
                        message: 'User Updated!',
                        position: 'bottom'
                    })
                });
        }
    }



}
</script>

