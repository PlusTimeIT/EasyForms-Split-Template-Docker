<script setup lang="ts">
import { InputForm } from "laravel-vue-easyforms/forms";
import { Button, Icon } from "laravel-vue-easyforms/elements";
import { TextField } from "laravel-vue-easyforms/fields";
import { ButtonTypes } from "laravel-vue-easyforms/enums";

const inputForm = new InputForm({
  name: "TestInputForm",
  type: "input-form",
  fields: [
    new TextField({
      name: "textfield_basic",
      placeholder: "This is a placeholder",
      label: "This is a label",
      required: true,
      cols: 12,
    }),
    new TextField({
      name: "textfield_masking",
      placeholder: "I'll look like this: ##-##-####",
      label: "Test out my masking to enforce types",
      masking: "##-##-####",
      required: true,
      cols: 12,
    }),
  ],
  buttons: [
    new Button({
      type: ButtonTypes.Process,
      text: "Process",
      color: "secondary",
      prepend_icon: new Icon({
        color: "accent",
        icon: "mdi-check",
      }),
    }),
    new Button({
      type: ButtonTypes.Reset,
      text: "Reset",
      prepend_icon: new Icon({
        color: "secondary",
        icon: "mdi-recycle",
      }),
    }),
  ],
});

console.log('INPUT VARIABLE FORM', inputForm);

function resetForm() {
  alert('this form was reset')
}
function formValidated() {
  alert('this form was validated')
}
</script>

<template>
  <v-sheet>
    <v-row>
      <v-col>
        <h1>[ Input Form ] Load - Basic Form From Variable</h1>
      </v-col>
    </v-row>
    <v-row>
      <v-col>Load Form from a Local Vue variable
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <form-loader :form="inputForm" @reset="resetForm" @validated="formValidated" />
      </v-col>
    </v-row>
  </v-sheet>
</template>