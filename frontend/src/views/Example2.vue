<template>
  <v-container
    app
    no-gutters
    fluid
    class="pa-0 ma-0 "
  > 
    <v-row
      no-gutters
      class="mt-2 mt-md-10"
    >
      <v-col
        cols="12"
        md="5"
        class="mx-auto mb-10 text-center"
      >
        <v-card tile class="glow-border">
          <v-sheet
            color="medgrey"
            class="pa-5"
          >
            <v-card-title class="font-weight-bold pb-8 title-2">
              ExampleForm2 
            </v-card-title>
            <v-card-text>
              <v-row>
                <form-loader
                  load_form="ExampleForm2"
                  @results="formProcessed"
                />
              </v-row>
            </v-card-text>
          </v-sheet>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">

import { appData } from "../mixins/store";
export default {
    name: 'LoginPage',
    mounted(){
        appData.setMainLoader(false);
    },
    created(){
        
    },
    methods: {
        formProcessed: function(event: any){
            // if successful
            if(event.result){
                this.$root.$emit("userUpdated", event.data);
            }
        }
    }
}


</script>