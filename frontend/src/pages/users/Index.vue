<template> 
    <div>
    
        <div class="q-pa-md">
            <q-table
            :data="users"
            :columns="columns"
            row-key="name"
            :hide-pagination="true" 
            :rows-per-page-options="[0]"
            :grid="$q.platform.is.mobile"
            >

            <template v-slot:body-cell-status="props">
            <q-td :props="props">
                <span :class="`text-white status-badge status-${props.row.status}`">{{ props.row.status }}</span>
            </q-td>
            </template>



            <template v-slot:body-cell-action="props">
                <q-td :props="props">
                    <template v-if="$q.platform.is.mobile">
                        <span rounded size="12px" text-color="grey-8"  @click="showEdit(props.row)">
                            Edit
                        </span>
                        <span rounded size="12px" text-color="grey-8"  @click="deleteUser(props.row)">
                            Delete
                        </span>
                    </template>
                    <template v-else>
                        <q-btn rounded size="12px" text-color="grey-8" icon="edit" @click="showEdit(props.row)"/>
                        <q-btn rounded size="12px" text-color="grey-8" icon="delete_outline" @click="deleteUser(props.row)"/>
                    </template>

                </q-td>
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

