<template>

    <q-dialog v-model="isOpen" persistent>
        <q-card :style="$q.screen.lt.md ? 'min-width: 300px' : 'min-width: 600px'">
            <q-form
                @submit.prevent="onSubmit"
                ref="form"
            >
                <q-card-section>
                    <div class="text-h6">Add Contacts</div>
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

export default {
    data() {
        return {
            isOpen: false,
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
        show() {
            this.isOpen = true
        },
        onSubmit() {
            api.post(`/api/users`, this.user)
                .then(({data}) => {
                    this.$q.notify({
                        type: 'positive',
                        message: 'User Created!',
                        position: 'bottom'
                    })

                    this.resetForm()

                    this.isOpen = false

                    this.$emit('userCreated');

                });
        },
        resetForm() {
            this.user = {
                name: '',
                username: '',
                email: '',
                phone: '',
                website: '',
                status: '',
                company: '',
                password: ''   
            }
        }
    }



}
</script>

