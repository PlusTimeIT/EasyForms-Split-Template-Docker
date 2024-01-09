<script setup>
import { ref, computed } from 'vue'
import router from './plugins/router'
import './styles/forms.css'

const drawer = ref(null)
const currentRoutes = computed(() => router.getRoutes().sort((a, b) => a.meta.order - b.meta.order));

</script>


<style lang="scss" scoped>
.v-col .loader {
  min-height: 250px;
}
</style>

<template>
  <v-app id="lvef-examples">
    <v-container class="d-flex flex-row align-start pa-0 align-stretch">
      <v-navigation-drawer app v-model="drawer" min-width="450px" permanent mini-variant expand-on-hover left>
        <v-sheet color="grey-lighten-4" class="pa-4">
          <div>Laravel Vue EasyForms Examples</div>
        </v-sheet>

        <v-divider />

        <v-list>
          <v-list-item v-for="route of currentRoutes" :key="route.name" :title="route.name" :to="route.path" />
        </v-list>
      </v-navigation-drawer>

      <v-main app class="pa-0">
        <router-view class="py-2 px-10" />
      </v-main>
    </v-container>
  </v-app>
</template>