<template>
  <q-header class="bg-white text-dark">
      <q-toolbar class="row justify-between q-py-sm" id="main-header">
        <div class="row" >
          <q-btn
            flat
            dense
            round
            icon="menu"
            aria-label="Menu"
            @click="emitLeftDrawerOpen"
          />
          
          <button class="text-blue-7 page-button q-ml-sm" v-show="!$q.screen.lt.md">Pages</button>

        </div>
        <q-list class="row" v-if="!$q.screen.lt.md">
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
        <div v-else>
          <q-btn
            flat
            dense
            round
            icon="menu"
            aria-label="Menu"
            @click="rightDrawerOpen = true"
          />
        </div>
      </q-toolbar>

      <div class="q-pl-md bg-white secondary-header" :class="!$q.screen.lt.md ? 'row justify-between items-center' : ''">
          <div class="row items-center">
            <p class="q-py-md" :class="!$q.screen.lt.md ? 'q-px-lg' : 'q-px-sm'">Contacts</p>
            <div class="search q-ml-md">
              <input type="text" placeholder="Search" :style="!$q.screen.lt.md ? '' : 'width:220px;'">
              <q-icon name="search" size="25px" color="grey-7"></q-icon>
            </div>
          </div>

          <div :class="!$q.screen.lt.md ? 'q-mr-sm' : 'q-my-sm q-mr-md'">
            <button class="text-blue-7" :class="$q.screen.lt.md ? 'btn-mobile' : ''"  @click="addContacts" v-if="this.$route.path == '/users'">Add Contacts</button>
            <button class="text-blue-7" :class="$q.screen.lt.md ? 'btn-mobile' : ''" @click="addAlbums" v-if="this.$route.path == '/albums'">Add Albums</button>
            <button class="text-blue-7" :class="$q.screen.lt.md ? 'btn-mobile' : ''" @click="addPhotos" v-if="this.$route.path == '/photos'">Add Photos</button>
          </div>
      </div>



      <q-drawer
        v-if="$q.screen.lt.md"
        show-if-above
        bordered
        side="right"
        class="text-dark"
        v-model="rightDrawerOpen"

      >
        <q-list>
          <q-item
            clickable
            tag="a"

            class="row items-center"

          >
            <q-item-section
              avatar
            >
              <q-icon name="layers" />
            </q-item-section>

            <q-item-section>
              <q-item-label class="sidebar-text">Pages</q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            clickable
            tag="a"

            class="row items-center"

          >
            <q-item-section
              avatar
            >
              <q-icon name="search" />
            </q-item-section>

            <q-item-section>
              <q-item-label class="sidebar-text">Search</q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            clickable
            tag="a"

            class="row items-center"

          >
            <q-item-section
              avatar
            >
              <q-icon name="forum" />
            </q-item-section>

            <q-item-section>
              <q-item-label class="sidebar-text">Messages</q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            clickable
            tag="a"

            class="row items-center"

          >
            <q-item-section
              avatar
            >
              <q-icon name="flag" />
            </q-item-section>

            <q-item-section>
              <q-item-label class="sidebar-text">Notifications</q-item-label>
            </q-item-section>
          </q-item>

          <q-item
            clickable
            tag="a"

            class="row items-center"

          >
            <q-item-section
              no-wrap
            >
              <div class="row items-center user-info">
                <span class="button">A</span>
                <span class="q-ml-sm sidebar-text">Hi, Admin</span>
              </div>
            </q-item-section>
          </q-item>
            
          
          <!-- <q-item
            clickable
            class="q-mx-sm row items-center"
          >
            
            <q-icon name=" search" size="25px" color="light-blue-7" />
            <q-item-label> Search </q-item-label>
          </q-item>
          <q-item
            clickable
            class="q-mx-sm row items-center"
          >
            <q-item-section
                no-wrap
              >
              <q-icon name="forum" size="25px" color="light-blue-7" />
            </q-item-section>
          </q-item>
          <q-item
            clickable
            class="q-mx-sm row items-center"
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
          </q-item> -->
        </q-list>
      </q-drawer>

    </q-header>
</template>

<script>

export default {
    name: 'Header',
    data() {
      return {
        rightDrawerOpen: false
      }
    },
    methods: {
      emitLeftDrawerOpen() {
        this.$root.$emit('toggleSidbar')
      },
      addContacts() {
        this.$root.$emit('addContacts')
      },
      addAlbums() {
        this.$root.$emit('addAlbums')

      },
      addPhotos() {
        this.$root.$emit('addPhotos')
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

  button.btn-mobile
    width: 100%

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