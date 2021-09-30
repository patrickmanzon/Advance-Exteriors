<template> 
    <div>
    
        <div class="q-pa-md">
            <q-table
            :data="albums"
            :columns="columns"
            row-key="name"
            :hide-pagination="true" 
            :rows-per-page-options="[0]"
            :grid="$q.screen.lt.md"
            >

            <template v-slot:body-cell-action="props"> 
                <q-td :props="props">
                    <q-btn unelevated  flat size="12px" text-color="grey-8">
                        <router-link :to="{name:'user-albums', params: { id: props.row.id }}" class="text-grey-8"><q-icon name="collections"></q-icon></router-link>
                    </q-btn>
                    <q-btn class="q-mr-sm" flat unelevated size="12px" text-color="grey-8" icon="edit" @click="showEdit(props.row)"/>
                    <q-btn class="q-mr-sm" flat unelevated size="12px" text-color="grey-8" icon="delete_outline" @click="deleteAlbum(props.row)"/>
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
                                <q-btn rounded class="q-mb-sm"  size="12px" text-color="grey-8">
                                    <router-link :to="{name:'album-photos', params: { id: props.row.id }}" class="text-grey-8 w-full" style="display:block;width:100%;"><q-icon name="collections"></q-icon></router-link>
                                </q-btn>
                                <q-btn class="q-mb-sm" rounded size="12px" text-color="grey-8" icon="edit" @click="showEdit(props.row)"/>
                                <q-btn class="q-mb-sm" rounded size="12px" text-color="grey-8" icon="delete_outline" @click="deleteAlbum(props.row)"/>
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

            <Edit ref="edit" @albumUpdated="getAlbums"/>
            <Create ref="create" @albumCreated="getAlbums"/>
            <Delete ref="delete" @albumDeleted="getAlbums"/>


        </div>
    </div>

</template>

<script>

import { api } from 'boot/axios'
import Edit from 'pages/albums/Edit.vue'
import Create from 'pages/albums/Create.vue'
import Delete from 'pages/albums/Delete.vue'

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
          name: "user",
          align: "left",
          label: "USER",
          field: row => row.user.name,
        },
        { name: 'action', label: 'ACTION', field: 'action', align: "left"}
      ],
      albums: [],
      nextPage: null,
      prevPage: null

    };
  },

  created() {
    this.getAlbums();

    this.$root.$on('addAlbums', () => {
        this.$refs.create.show()
    })


  },

  methods: {
    getAlbums(page = 1) {
        console.log("Hello"); 
        api.get(`/api/users/${this.$route.params.id}/albums?page=${page}`)
            .then(({data}) => {
                console.log("Hello"); 

                this.albums = data.albums.data
                this.nextPage = !!data.albums.next_page_url ? data.albums.next_page_url.split('page=')[1] : null
                this.prevPage = !!data.albums.prev_page_url ? data.albums.prev_page_url.split('page=')[1] : null
            });
    },
    previous() {
        this.getAlbums(this.prevPage);
    },
    next() {
        this.getAlbums(this.nextPage);
    },
    showEdit(album) {
        this.$refs.edit.show(album);
    },
    deleteAlbum(album) {
        this.$refs.delete.show(album);
    }
  }
};
</script>

<style>

</style>

