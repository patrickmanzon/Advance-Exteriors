<template> 
    <div>
    
        <div class="q-pa-md">
            <q-table
            :data="users"
            :columns="columns"
            row-key="name"
            :hide-pagination="true" 
            :rows-per-page-options="[0]"
            :grid="$q.screen.lt.md"
            >

            <template v-slot:body-cell-status="props">
            <q-td :props="props">
                <span :class="`text-white status-badge status-${props.row.status}`">{{ props.row.status }}</span>
            </q-td>
            </template>



            <template v-slot:body-cell-action="props">
                <q-td :props="props">
                    <div class="row items-center">
                        <q-btn rounded size="12px" flat text-color="grey-8">
                            <router-link :to="{name:'user-albums', params: { id: props.row.id }}" class="text-grey-8"><q-icon name="collections"></q-icon></router-link>
                        </q-btn>
                        <!-- <q-btn rounded size="12px" flat text-color="grey-8" icon="collections" /> -->
                        <q-btn rounded size="12px" flat text-color="grey-8" icon="edit" @click="showEdit(props.row)"/>
                        <q-btn rounded size="12px" flat text-color="grey-8" icon="delete_outline" @click="deleteUser(props.row)"/>
                    </div>
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
                            <q-item-section v-else>
                                <q-btn rounded size="12px" class="q-mb-sm">
                                    <router-link :to="{name:'user-albums', params: { id: props.row.id }}" class="text-grey-8" style="width: 100%;"><q-icon name="collections"></q-icon></router-link>
                                </q-btn>
                                <q-btn rounded size="12px" text-color="grey-8" icon="edit" @click="showEdit(props.row)" class="q-mb-sm"/>
                                <q-btn rounded size="12px" text-color="grey-8" icon="delete_outline" @click="deleteUser(props.row)" class="q-mb-sm"/>
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

            <Edit ref="edit"/>
            <Create ref="create" @userCreated="getUsers"/>
            <Delete ref="delete" @userDeleted="getUsers"/>


        </div>
    </div>

</template>

<script>

import { api } from 'boot/axios'
import Edit from 'pages/users/Edit.vue'
import Create from 'pages/users/Create.vue'
import Delete from 'pages/users/Delete.vue'

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
          name: "name",
          align: "left",
          label: "CUSTOMER",
          field: "name",
        },
        {
          name: "phone",
          align: "left",
          label: "PHONE",
          field: "phone",
        },
        { name: "website", label: "WEBSITE", field: "website" ,align: 'left'},
        { name: "company", label: "COMPANY NAME", field: "company" ,align: 'left'},
        { name: "status", label: "STATUS", field: "status", align: "left",},
        { name: 'action', label: 'ACTION', field: 'action', align: "left",}
      ],
      users: [],
      nextPage: null,
      prevPage: null

    };
  },

  created() {
    this.getUsers();

    this.$root.$on('addContacts', () => {
        this.$refs.create.show()
    })


  },

  methods: {
    getUsers(page = 1) {
        api.get(`/api/users?page=${page}`)
            .then(({data}) => {
                this.users = data.users.data
                this.nextPage = !!data.users.next_page_url ? data.users.next_page_url.split('page=')[1] : null
                this.prevPage = !!data.users.prev_page_url ? data.users.prev_page_url.split('page=')[1] : null
            });
    },
    previous() {
        this.getUsers(this.prevPage);
    },
    next() {
        this.getUsers(this.nextPage);
    },
    showEdit(user) {
        this.$refs.edit.show(user);
    },
    deleteUser(user) {
        this.$refs.delete.show(user);
    }
  }
};
</script>

<style>

</style>

