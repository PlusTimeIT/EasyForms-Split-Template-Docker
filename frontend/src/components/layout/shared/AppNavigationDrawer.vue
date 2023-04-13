<template>
    <v-container>
        <router-link to="/">
        <v-skeleton-loader
            type="image"
            alt="Platform Logo"
            class="mx-auto transition-long"
            transition="slide-x-transition"
            width="150"
            height="100"
            contain
        />
        </router-link>
        <v-list dense>
            <nav-item 
                v-for="(route) in getFilteredRoutes()" 
                :key="route.name" 
                :route="route" 
            />
        </v-list>
        
    </v-container>
</template>

<script>

import NavItem from '../../lists/NavItem.vue';
import { appData } from "../../../mixins/store";

export default {
  name: 'AppNavigationDrawer',
  components:{
    NavItem,
  },
  data: () => ({
    activeLink: null
  }),
  computed: {
    loadedType: function(){
        return this.type;
    },
  },
  props: {
    type:{
        type: String,
        default: 'user'
    }
  },
  methods: {
    getFilteredRoutes: function(){
        const _this = this
        const getRoutes = this.$router.options.routes.filter(route => route.meta.portal == _this.loadedType && route.meta.topLevel == true)
        const sideNavRoutes = getRoutes[0].children.filter(route => route.meta.sideNav.show === true)
        return sideNavRoutes.filter( route => (appData.user.role == 'superAdmin' ? true : (route.meta.permission === undefined ? true : (appData.user.permissions.filter(e => e.name === route.meta.permission).length > 0))));
    },
  },
};
</script>

<style>
    .v-list-group__header{
        padding: 0px!important;
    }

</style>