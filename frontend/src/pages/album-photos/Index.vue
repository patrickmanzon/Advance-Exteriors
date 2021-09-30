<template> 
    <div>
    
        <div class="q-pa-md">
            <q-table
            :data="photos"
            :columns="columns"
            row-key="name"
            :hide-pagination="true" 
            :rows-per-page-options="[0]"
            :grid="$q.screen.lt.md"
            >

            <template v-slot:body-cell-action="props">
                <q-td :props="props">
                    <template v-if="$q.screen.lt.md">
                        <span class="q-mr-sm"  size="12px" text-color="grey-8"  @click="showEdit(props.row)">
                            Edit
                        </span>
                        <span class="q-mr-sm" size="12px" text-color="grey-8"  @click="deletePhoto(props.row)">
                            Delete
                        </span>
                    </template>
                    <template v-else>
                        <q-btn class="q-mr-sm" unelevated size="12px" text-color="grey-8" icon="edit" @click="showEdit(props.row)"/>
                        <q-btn class="q-mr-sm" unelevated size="12px" text-color="grey-8" icon="delete_outline" @click="deletePhoto(props.row)"/>
                    </template>

                </q-td>
            </template>

            <template v-slot:item="props">
                <div
                class="q-pa-xs col-xs-12 col-sm-6 col-md-4 col-lg-3 grid-style-transition"
                :style="props.selected ? 'transform: scale(0.95);' : ''"
                >
                <q-card>
                    <q-list dense>
                        <q-item v-for="col in props.cols" :key="col.name">
                            <q-item-section v-if="col.name != 'action'">
                                <q-item-label>{{ col.name + ' : ' +col.value }}</q-item-label>
                            </q-item-section>
                            <q-item-section v-else class="row justify-between">
                                <q-btn class="q-mb-sm" rounded size="12px" text-color="grey-8" icon="edit" @click="showEdit(props.row)"/>
                              <q-btn class="q-mb-sm" rounded size="12px" text-color="grey-8" icon="delete_outline" @click="deletePhoto(props.row)"/>
                            </q-item-section>
                        </q-item>
                    </q-list>
                </q-card>
                </div>
            </template>


            </q-table>

            <div class="row justify-between q-mt-lg">
                <q-btn color="white" text-color="grey-8" style="border-radius: 10px; text-transform: capitalize;" unelevated label="Previous" @click="previous" :disable="!prevPage"/>
                <q-btn color="white" text-color="grey-8" style="border-radius: 10px; text-transform: capitalize;" unelevated label="Next" 
                @click="next" :disable="!nextPage"/>
            </div>

            <Edit ref="edit" @photoUpdated="getPhotos"/>
            <Create ref="create" @photoCreated="getPhotos"/>
            <Delete ref="delete" @photoDeleted="getPhotos"/>


        </div>
    </div>

</template>

<script>

import { api } from 'boot/axios'
import Edit from 'pages/photos/Edit.vue'
import Create from 'pages/photos/Create.vue'
import Delete from 'pages/photos/Delete.vue'

export default {
    components: {
        Edit,
        Create,
        Delete
    },
  data() {
    return {
      columns: [ 
        {
          name: "id",
          required: true,
          label: "#",
          align: "left",
          field: 'id',
          sortable: false
        },
        {
          name: "title",
          align: "left",
          label: "TITLE",
          field: "title",
        },
        {
          name: "url",
          align: "left",
          label: "URL",
          field: 'url',
        },
        {
          name: "thumbnail_url",
          align: "left",
          label: "THUMBNAIL URL",
          field: 'thumbnail_url',
        },
        {
          name: "album",
          align: "left",
          label: "ALBUM",
          field: row => row.album.title,
        },
        { name: 'action', label: 'ACTION', field: 'action', align: "left"}
      ],
      photos: [],
      albums: [],
      nextPage: null,
      prevPage: null

    };
  },

  created() {
    this.getPhotos();

    this.$root.$on('addPhotos', () => {
        this.$refs.create.show()
    })

  },

  methods: {
    getPhotos(page = 1) {
        api.get(`/api/albums/${this.$route.params.id}/photos?page=${page}`)
            .then(({data}) => {

                this.photos = data.photos.data
                this.nextPage = !!data.photos.next_page_url ? data.photos.next_page_url.split('page=')[1] : null
                this.prevPage = !!data.photos.prev_page_url ? data.photos.prev_page_url.split('page=')[1] : null
                console.log(this.photos);
            });
    },
    previous() {
        this.getPhotos(this.prevPage);
    },
    next() {
        this.getPhotos(this.nextPage);
    },
    showEdit(photo) {
        this.$refs.edit.show(photo);
    },
    deletePhoto(photo) {
        this.$refs.delete.show(photo);
    }
  }
};
</script>

<style>

</style>

