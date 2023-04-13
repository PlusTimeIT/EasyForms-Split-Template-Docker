<template>
  <v-row>
    <v-col
      cols="12"
      class="my-2 mx-auto text-center caption"
      v-text="copyrightMessage"
    />
  </v-row>
</template>

<script lang="ts">

export default {
    name: 'AppFooter',
    computed:{
        copyrightMessage: function(){
            return '© ' + new Date().getFullYear() + ' ' + this.$appLegalName + '. All rights reserved.';
        },
    }
    
}
</script>