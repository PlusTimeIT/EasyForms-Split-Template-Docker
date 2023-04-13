<template>
  <v-btn 
    v-scroll-to="'#' + loaded_id"
    v-bind="btn_props"
    v-text="btn_props.content"
  />
</template>

<script lang="ts">

export default {
    name: 'BtnDrivers',
    props:{
        bindings: {
            type: Object,
            default: (() => {})
        },
        id: {
            type: String,
            default: ''
        }
    },
    computed:{
        btn_props: function(){
            let defaults = {
                content: "Track your parcel",
                rounded: true,
                color: 'secondary'
            };
            return { ...defaults, ...this.loaded_bindings}
        },
        loaded_bindings: function() {
            return this.bindings;
        },
        loaded_id: function() {
            return this.id;
        }
    },
    created(){
        this.$status.loading = false;
    }
}

</script>