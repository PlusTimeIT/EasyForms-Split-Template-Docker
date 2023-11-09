<script setup lang="ts">

</script>

<template>
  <v-container>
    <v-row>
      <v-col>
        <h1> [ Multiple Forms ] Load Multiple At Once</h1>
      </v-col>
    </v-row>
    <v-row>
      <v-col>Load Form from Server with miltiple forms
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <h2>Form 1 </h2>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <form-loader name="Input\BasicServer" />
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-divider />
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <h2>Form 4 </h2>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <form-loader name="Action\IconsServer" />
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-divider />
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <h2>Form 2 </h2>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <form-loader name="Input\ComplexServer" />
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-divider />
      </v-col>
    </v-row>
  </v-container>
</template>