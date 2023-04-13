<template>
  <v-container
    app
    no-gutters
    fluid
    class="pa-0 ma-0"
  >
    Home Page
  </v-container>
</template>

<script lang="ts">
import { appData } from "../mixins/store";

export default {
    name: 'HomePage',
    components: {

    },
    mounted(){
        appData.setMainLoader(false);
    },
    created(){
        
    }
}

</script>

<style lang="scss">

</style>