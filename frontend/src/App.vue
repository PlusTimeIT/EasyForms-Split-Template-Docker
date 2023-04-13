<template>
  <v-app>
    <loading-overlay :loading="pageLoading"/>
    <transition name="fade">
      <component v-if="currentLayout !== null" :is="currentLayout" />
    </transition>
  </v-app>
</template>

<script>

import GuestLayout from './layouts/GuestLayout.vue';
import LoadingOverlay from './components/layout/shared/LoadingOverlay.vue';
import { appData } from "./mixins/store";

export default {
    name: 'App',
    components: {
        GuestLayout,
        LoadingOverlay
    },
    data: () => ({
        
    }),
    computed: {
        pageLoading() {
            return appData.mainLoader
        },
        currentLayout:{
            get(){
                return appData.currentLayout
            },
            set(newVal){
                appData.setLayout(newVal)
            },
            // find current layout
        }
    },
    created() {
        this.$router.onReady(() => {
            this.currentLayout = 'GuestLayout';
            appData.setMainLoader(false);
        })
    },
    async mounted(){
        if(!this.$crsfToken.loading && this.$crsfToken.token === false){
            this.$crsfToken.loading = true;
            await this.fetchNewToken();
        }
    },
    methods: {
        async fetchNewToken(){
            const _this = this;
            return window.axios.get("/api/csrf-cookie")
            .then(function(){   
                _this.$crsfToken.loading = false;
                _this.$crsfToken.token = true;
            });
        },
    },
};
</script>