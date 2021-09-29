<template>
  <q-layout view="lHh Lpr lFf" class="bg-grey-3">
    <Header />

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      dark
      :mini="miniState"
      class="text-white"

    >
      <q-list>
        <q-item-label
          class="bg-darker text-white q-py-lg q-px-lg flex justify-between"
        >
          <span class="text-h5">Advance Exteriors</span>
          <q-btn
            flat
            dense
            round
            icon="keyboard_double_arrow_left"
            aria-label="Menu"
            @click="miniState = true"
          />
        </q-item-label>
        <q-item
          v-show="miniState"
          clickable>
          <q-btn
            flat
            dense
            round
            icon="keyboard_double_arrow_right"
            aria-label="Menu"
            @click="miniState = false"
          />
        </q-item>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
          class="q-my-sm"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <div>
        <router-view />
      </div>
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from 'components/EssentialLink.vue'
import Header from 'components/Header.vue'

const linksData = [
  {
    title: 'Dasboard',
    icon: 'school',
    link: '#'
  },
  {
    title: 'Employee',
    icon: 'code',
    link: '#'
  },
  {
    title: 'Subcontructor',
    icon: 'record_voice_over',
    link: '#'
  },
  {
    title: 'Supplier',
    icon: 'rss_feed',
    link: '#'
  },
  {
    title: 'Users',
    icon: 'favorite',
    link: '#'
  },
  {
    title: 'File Upload',
    icon: 'favorite',
    link: '#'
  },
  {
    title: 'Widgets',
    icon: 'favorite',
    link: '#'
  },
  {
    title: 'Calendar',
    icon: 'favorite',
    link: '#'
  },
  {
    title: 'Charts',
    icon: 'favorite',
    link: '#'
  },
  {
    title: 'Maps',
    icon: 'favorite',
    link: '#'
  },
  {
    title: 'Miscellaneous',
    icon: 'favorite',
    link: '#'
  },
];

export default {
  name: 'MainLayout',
  components: { EssentialLink, Header },
  data () {
    return {
      leftDrawerOpen: false,
      miniState:false,
      essentialLinks: linksData
    }
  },
  created() {
    this.$root.$on('toggleSidbar', () => {
      this.leftDrawerOpen = !this.leftDrawerOpen
    })
  }
}
</script>
