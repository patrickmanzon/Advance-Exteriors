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
          class="bg-darker text-white q-py-lg q-px-lg flex justify-between q-mb-lg"
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
          :key="link.key"
          v-bind="link"
          :label="!!link.label"
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
    icon: 'grid_view',
    link: '#',
    key: Math.random()
  },
  {
    title: 'CUSTOM',
    label: true,
    key: Math.random()
  },
  {
    title: 'Employee',
    icon: 'grid_view',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Calendar',
    icon: 'event',
    link: '#',
    key: Math.random()
  },
  {
    title: 'FEATURE',
    label: true,
    key: Math.random()
  },
  {
    title: 'Subcontructor',
    icon: 'grid_view',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Supplier',
    icon: 'inventory_2',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Calendar',
    icon: 'event',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Users',
    icon: 'people',
    link: '#',
    key: Math.random()
  },
  {
    title: 'File Upload',
    icon: 'file_upload',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Widgets',
    icon: 'widgets',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Calendar',
    icon: 'event',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Charts',
    icon: 'signal_cellular_alt',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Maps',
    icon: 'map',
    link: '#',
    key: Math.random()
  },
  {
    title: 'Miscellaneous',
    icon: 'account_balance_wallet',
    link: '#',
    key: Math.random()
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
