<template>

    <q-dialog v-model="isEdit" persistent>
        <q-card :style="$q.screen.lt.md ? 'min-width: 300px' : 'min-width: 600px'">
            <q-form
                @submit.prevent="onSubmit"
            >
                <q-card-section>
                    <div class="text-h6">Edit {{ photo.title }}</div>
                </q-card-section>

                <div class="q-gutter-md q-px-lg">
                    <div>
                        <q-input outlined v-model="photo.title" label="Title" />
                    </div>
                    <div>
                        <q-input outlined v-model="photo.url" label="Url" />
                    </div>
                    <div>
                        <q-input outlined v-model="photo.thumbnail_url" label="Album" />
                    </div>
                    <div>
                        <q-select outlined v-model="photo.album_id" :options="albums" option-value="id" emit-value option-label="label" map-options label="Album" />
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
            albums: [],
            photo: {
                album_id: '',
                title: '',
                url: '',
                thumbnail_url: ''
            }
        }
    },

    methods: {
        show(photo) {
            this.isEdit = true
            this.photo = photo
        },
        onSubmit() {
            api.put(`/api/photos/${this.photo.id}`, this.photo)
                .then(({data}) => {
                    this.$q.notify({
                        type: 'positive',
                        message: 'Photo Updated!',
                        position: 'bottom'
                    })

                    this.$emit('photoUpdated');
                    
                });
        },
        getAlbums() {
            api.get(`/api/albums?all=1`)
                .then(({data}) => {
                    this.albums = data.albums.map(album => {
                        return {
                            label: album.title,
                            id: album.id
                        }
                    });
                });
        }
    },

    created() {
        this.getAlbums();
    }



}
</script>

