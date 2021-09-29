<template>
  <q-header class="bg-white text-dark">
      <q-toolbar class="row justify-between q-py-sm" id="main-header">
        <div class="row">
          <q-btn
            flat
            dense
            round
            icon="menu"
            aria-label="Menu"
            @click="emitLeftDrawerOpen"
          />
          
          <button class="text-blue-7 page-button q-ml-sm">Pages</button>
        </div>
        <q-list class="row">
          <q-item
            clickable
            class="q-mx-sm flex justify-center"
          >
            <q-item-section
                no-wrap
              >
              <q-icon name=" search" size="25px" color="light-blue-7" />
            </q-item-section>
          </q-item>
          <q-item
            clickable
            class="q-mx-sm flex justify-center"
          >
            <q-item-section
                no-wrap
              >
              <q-icon name="forum" size="25px" color="light-blue-7" />
            </q-item-section>
          </q-item>
          <q-item
            clickable
            class="q-mx-sm flex justify-center"
          >
            <q-item-section
                no-wrap
              >
              <q-icon name="flag" size="25px" color="light-blue-7" />
            </q-item-section>
          </q-item>
          <q-item
            clickable
            class="q-mx-sm flex justify-center"
          >
            <q-item-section
                no-wrap
              >
              <div class="row justify-between items-center user-info">
                <span class="q-mr-sm">Hi, </span>
                <span class="q-mr-sm">Admin</span>
                <span class="button">A</span>
              </div>
            </q-item-section>
          </q-item>
        </q-list>
      </q-toolbar>

      <div class="q-pl-md row items-center justify-between bg-white secondary-header">
          <div class="row items-center">
            <p class="q-px-lg q-py-md">Contacts</p>
            <div class="search q-ml-sm">
              <input type="text" placeholder="Search">
              <q-icon name="search" size="25px" color="grey-7"></q-icon>
            </div>
          </div>

          <div class="q-mr-sm">
            <button class="text-blue-7" @click="addContacts" v-if="this.$route.path == '/users'">Add Contacts</button>
            <button class="text-blue-7" @click="addAlbums" v-if="this.$route.path == '/albums'">Add Albums</button>
          </div>

      </div>
    </q-header>
</template>

<script>

export default {
    name: 'Header',
    methods: {
      emitLeftDrawerOpen() {
        this.$root.$emit('toggleSidbar')
      },
      addContacts() {
        this.$root.$emit('addContacts')
      },
      addAlbums() {
        this.$root.$emit('addAlbums')

      }
    }

}
</script>

<style scoped lang="sass">
.secondary-header
  p
    border-right: 1px solid #E5E5E5!important
    margin: 0
    font-size: 16px
    font-weight: 500
  .search
    position: relative
    
    input
      padding: 5px
      border-radius: 10px
      outline: none
      border: 2px solid #E5E5E5!important
      background-color: #E5E5E5!important
      width: 250px
      height: 40px
      font-size: 16px
  .q-icon
    right: 12%

  button
    background-color: #E5E5E5!important
    border: none
    padding: 10px 10px
    border-radius: 8px
    margin-right: 25px
    text-align: center
    text-decoration: none
    display: inline-block
    font-size: 16px
    cursor: pointer

.page-button
  background-color: #E5E5E5!important
  border: none
  padding: 10px 10px
  border-radius: 8px
  text-align: center
  text-decoration: none
  display: inline-block
  font-size: 16px
  cursor: pointer

.user-info
  span.button
    background-color: #1AAB8B!important
    border: none
    color: #fff
    padding: 10px 15px
    border-radius: 8px
    text-align: center
    text-decoration: none
    display: inline-block
    font-size: 16px


</style>