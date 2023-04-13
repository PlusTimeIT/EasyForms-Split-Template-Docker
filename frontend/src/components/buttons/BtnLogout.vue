<template>
  <v-btn 
    v-bind="btnProps"
    @click="logoutUser"
    v-text="btnProps.content"
  />
</template>

<script lang="ts">
import { appData } from "../../mixins/store";

export default {
    name: 'BtnLogout',
    props:{
        bindings: {
            type: Object,
            default: (() => {})
        }
    },
    computed:{
        btnProps: function(){
            const defaults = {
                content: "Logout",
                rounded: false,
                tile: true,
                color: 'secondary'
            };
            return { ...defaults, ...this.loadedBindings}
        },
        loadedBindings: function() {
            return this.bindings;
        },
        loadedUser: function() {
            return this.bindings;
        },
    },
    methods:{
        async logoutUser(){
            appData.setMainLoader(true)
            const response = await appData.user.logout()
            if (response) {
                this.$root.$emit("userUpdated", {});
                this.$router.push({ name: "Login"})                  
            }
        },
    }
}

</script>