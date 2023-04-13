<template>
  <v-overlay
    :value="mainLoader"
    :opacity="80"
    :z-index="2"
    color="white"

  >
    <v-progress-circular
      indeterminate
      size="64"
      class="mx-auto"
      color="primary"
    />
  </v-overlay>
</template>

<script>
    import { appData } from "../../../mixins/store";

    export default {
        props:{
            loading: {
                type: Boolean,
                default: true 
            }
        },
        computed: {
            mainLoader(){
                return this.loading
            }
        }
    };
</script>
