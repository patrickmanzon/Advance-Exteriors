<template> 
    <div>
    
        <div class="q-pa-md">
            <q-table
            :data="albums"
            :columns="columns"
            row-key="name"
            :hide-pagination="true" 
            :rows-per-page-options="[0]"
            :grid="$q.platform.is.mobile"
            >

            <template v-slot:body-cell-action="props">
                <q-td :props="props">
                    <template v-if="$q.platform.is.mobile">
                        <span class="q-mr-sm"  size="12px" text-color="grey-8"  @click="showEdit(props.row)">
                            Edit
                        </span>
                        <span class="q-mr-sm" size="12px" text-color="grey-8"  @click="deleteAlbum(props.row)">
                            Delete
                        </span>
                    </template>
                    <template v-else>
                        <q-btn class="q-mr-sm" unelevated size="12px" text-color="grey-8" icon="edit" @click="showEdit(props.row)"/>
                        <q-btn class="q-mr-sm" unelevated size="12px" text-color="grey-8" icon="delete_outline" @click="deleteAlbum(props.row)"/>
                    </template>

                </q-td>
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
        api.get(`/api/albums?page=${page}`)
            .then(({data}) => {
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

