<template>
  <div>
    <top-app-bar />
    <v-main>
      <router-view />
    </v-main>
    <app-footer />
  </div>
</template>

<script>

    import TopAppBar from '../components/layout/guest/AppBar.vue';
    import AppFooter from '../components/layout/guest/Footer.vue';
    
    export default {
        name: 'App',
        components: {
            TopAppBar,
            AppFooter
        },
        watch: {
        $route: {
            immediate: true,
            handler(to) {
                // Add page title
                const title = to.meta.title || to.name || 'Loading...'
                document.title = title + ' - ' + this.$appName
            }
        },
    },
    }
</script>