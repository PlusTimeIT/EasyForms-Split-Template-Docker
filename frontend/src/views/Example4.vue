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
        md="8"
        class="mx-auto mb-10 text-center"
      >
        <v-card tile class="glow-border">
          <v-sheet
            color="medgrey"
            class="pa-5"
          >
            <v-card-title class="font-weight-bold pb-8 title-2">
              ExampleForm4 
            </v-card-title>
            <v-card-text>
              <v-row>
                <v-col cols="12">
                  <v-simple-table class="w-100">
                      <template v-slot:default>
                          <thead>
                          <tr>
                              <th class="text-center">
                                  ID
                              </th>
                              <th class="text-center">
                                  User Colour
                              </th>
                              <th class="text-center">
                                  Name
                              </th>
                              <th class="text-center">
                                  Username
                              </th>
                              <th class="text-center">
                                  Email
                              </th>
                              <th class="text-center">
                                  Status
                              </th>
                              <th class="text-center">
                                  Created At
                              </th>
                              <th class="text-center">
                                  Actions
                              </th>
                          </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(user, index) in users" :key="index">
                                  <td class="text-center">{{ user.id }}</td>
                                  <td class="text-center">
                                      <v-chip
                                          class="ma-2"
                                          :color="user.colour"
                                          outlined
                                      >
                                          {{ user.username[0] }}
                                      </v-chip>
                                  </td>
                                  <td class="text-center">{{ user.name }}</td>
                                  <td class="text-center">{{ user.username }}</td>
                                  <td class="text-center">{{ user.email }}</td>
                                  <td class="text-center">
                                      <v-chip
                                          v-if="user.status == 'active'"
                                          class="ma-2"
                                          color="green"
                                          outlined
                                      >
                                          {{user.status}}
                                      </v-chip>
                                      <v-chip
                                          v-if="user.status == 'inactive'"
                                          class="ma-2"
                                          color="orange"
                                          outlined
                                      >
                                          {{user.status}}
                                      </v-chip>
                                      <v-chip
                                          v-if="user.status == 'banned'"
                                          class="ma-2"
                                          color="red"
                                          outlined
                                      >
                                          {{user.status}}
                                      </v-chip>
                                  </td>
                                  <td class="text-center">
                                      {{ user.created_at }}
                                  </td>
                                  <td class="text-center">
                                    <form-loader
                                      load_form="ExampleForm4"
                                      :cols="12"
                                      class="mx-auto"
                                      :additional_form_data="returnUserData(user)"
                                      @results="formProcessed"
                                    />
                                  </td>
                              </tr>
                          </tbody>
                      </template>
                  </v-simple-table>
              </v-col>
              <v-col>
                  <form-loader 
                    :cols="12" 
                    class="mx-auto" 
                    load_form="ResetCacheForm"
                  />
              </v-col>
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
    data: () => ({
      loadedIcon: false,
      users: [
        {
        id: 1,
        color: 'red',
        name: 'Testing Mcgee',
        username: 'TestUser',
        email: 'TestUser@test.com',
        status: 'active',
        created_at: '2023-04-13',
      },
      {
        id: 2,
        color: 'blue',
        name: 'Tester Bcgee',
        username: 'TestUser2',
        email: 'TestUser2@test.com',
        status: 'inactive',
        created_at: '2023-04-13',
      },
      {
        id: 2,
        color: 'blue',
        name: 'Tester Bcgee',
        username: 'TestUser2',
        email: 'TestUser2@test.com',
        status: 'inactive',
        created_at: '2023-04-13',
      }
    ]
    }),
    mounted(){
        appData.setMainLoader(false);
    },
    methods: {
      formProcessed: function(event: any){
          // if successful
          if(event.result){
              this.$root.$emit("userUpdated", event.data);
          }
      },
      returnUserData(user){
        // we don't have to pass the full user object, just what we need to identify the user (id in this case)
        // and what we need for the conditional checks (status in this case)
        return { "id": user.id, "status": user.status }
      },
      iconClick(identifier) {

      }
    }
}


</script>