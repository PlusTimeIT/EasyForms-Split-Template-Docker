<template>
  <v-footer 
    app 
    color="grey"
    dark
    bottom 
    absolute
    padless
  >
    <v-card 
      class="flex pt-10 pb-3"
      color="grey"
      flat
      tile
    >
      <v-row
        no-gutters
        class="pt-10 mb-8"
      >
        <v-col
          cols="12"
          md="5"
          class="mx-auto text-center"
        >
            {{ this.$appName }}
        </v-col>
        <v-col
          cols="12"
          md="7"
          class="mx-auto text-center text-md-left"
        >
          <v-list 
            id="footer-links"
            color="grey"
            :class="getColumns"
          >
            <v-hover 
              v-for="(item, index) in filteredRoutes"  
              :key="index"  
              v-slot="{ hover }"
            >
              <v-list-item 
                v-scroll-to="'#top-menu'"
                :to="item.path"
                :class="hover ? 'orange--text' : 'white--text'"
              >
                <v-list-item-content>
                  <v-list-item-title>
                    {{ item.meta.footer.text ?? item.name }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-hover>
          </v-list>
        </v-col>
      </v-row> 
      <v-divider class="footer-divider" />
      <v-row no-gutters>
        <v-col
          cols="12"
          class="mt-5 mx-auto text-center text-caption"
        >
        {{ copyrightMessage }}
        </v-col>
      </v-row>
    </v-card>
  </v-footer>
</template>

<script lang="ts">
    export default {
        name: 'AppFooter',
        computed:{
            getColumns: function(){
                if(this.$vuetify.breakpoint.mdAndUp){
                    return 'md-column_wrapper';
                }
                return 'column_wrapper';
            },
            copyrightMessage: function(){
                return '© ' + new Date().getFullYear() + ' ' + this.$appLegalName + '. All rights reserved.';
            },
            filteredRoutes: function(){
                return this.$router.options.routes.filter(route => route.meta.portal == 'guest' && route.meta.footer.show === true);
            }
        }
        
    }
</script>

<style lang="scss">

</style>