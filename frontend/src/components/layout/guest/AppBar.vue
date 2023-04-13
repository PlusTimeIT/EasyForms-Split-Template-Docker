<template>
  <v-app-bar
    id="top-menu"
    app
    color="secondary"
    class="flex text-center"
    dark
    hide-on-scroll
    height="80"
  > 
    <v-spacer class="hidden-sm-and-down" />
    <v-app-bar-title>
      <router-link to="/">
        {{ this.$appName }}
      </router-link>
    </v-app-bar-title>
    <v-spacer />
    <div class="hidden-sm-and-down">
      <v-hover 
        v-for="(item, index) in filteredRoutes"  
        :key="index"  
        v-slot="{ hover }"
      >
        <v-btn 
          :to="item.path"
          :color="hover ? item.meta.topNav.color.hover : item.meta.topNav.color.default"
          :rounded="item.meta.topNav.type == 'rounded' ? true : false"
          :tile="item.meta.topNav.type == 'tile' ? true : false"
          class="mx-1"
          :class="hover ? item.meta.topNav.class.hover.text : item.meta.topNav.class.text"
        >
          {{ item.meta.topNav.text ?? item.name }}
        </v-btn>
      </v-hover>
    </div>
    <v-menu
      offset-y
      class="hidden-md-and-up"
    >
      <template #activator="{ on, attrs }">
        <v-app-bar-nav-icon 
          class="hidden-md-and-up"
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
        />
      </template>
      <v-list color="grey">
        <v-list-item
          v-for="(item, index) in filteredRoutes"
          :key="index"
        >
          <v-list-item-content class="white--text">
            <v-list-item-title>
              {{ item.meta.topNav.text ?? item.name }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-menu> 
    <v-spacer class="hidden-sm-and-down" />        
  </v-app-bar>
</template>

<script>

export default {
  name: 'AppBar',
  data: () => ({
    menu: false,
  }),
  computed:{
    filteredRoutes: function(){
        return this.$router.options.routes.filter(route => route.meta.portal == 'guest' && route.meta.topNav.show === true);
    },
    logoWidth(){
        switch (this.$vuetify.breakpoint.name) {
          case 'xs': return 150
          case 'sm': return 200
          case 'md': return 200
          case 'lg': return 200
          case 'xl': return 200
        }
        return 10
    }
  }
};
</script>

<style scoped>

    

</style>