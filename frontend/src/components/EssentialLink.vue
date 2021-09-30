<template>
  <div>
    <q-item
      clickable
      tag="a"
      :to="link"
      class="row items-center"
      v-if="!label"
    >
      <q-item-section
        v-if="icon"
        avatar
      >
        <q-icon :name="icon" />
      </q-item-section>

      <q-item-section>
        <q-item-label class="sidebar-text">{{ title }}</q-item-label>
      </q-item-section>
    </q-item>

    <q-item
      :href="link"
      class="row items-center"
      v-else
    >
    <q-item-section>
        <q-item-label class="header-label">{{ title }}</q-item-label>
      </q-item-section>
    </q-item>

  </div>
</template>

<script>
export default {
  name: 'EssentialLink',
  props: {
    title: {
      type: String,
      required: true
    },

    caption: {
      type: String,
      default: ''
    },

    link: {
      type: String,
      default: '#'
    },

    icon: {
      type: String,
      default: ''
    },

    label: {
      type: Boolean
    }
  }
}
</script>
