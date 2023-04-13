<template>
  <v-avatar 
    v-bind="avatarBindings" 
  >
    <img
      v-if="avatar.type == 'image'"
      :src="loadedMicroserviceUrl + avatar.resource"
      alt="Users Avatar Image"
    >
    
    <span
      v-if="avatar.type == 'initials'"
      :class="'white--text ' + getTextSize(avatar.size)"
    >{{ avatar.resource }}</span>

    <v-icon
      v-if="avatar.type == 'default'"
      :size="getIconSize(avatar.size)"
      color="white"
    >
      mdi-account-circle
    </v-icon>
  </v-avatar>
</template>

<script>
  import { appData } from "../../../../mixins/store";
  import { User } from '../../../../classes/User';

export default {
    name: 'UserAvatar',
    props: {
      custom: {
        type: Boolean,
        default: false
      },
      type: {
        type: String,
        default: 'default'
      },
      resource: {
        type: String,
        default: ''
      },
      size:{
        type: String,
        default: 'medium'
      },
      color:{
        type: String,
        default: 'primary'
      },
      tile:{
        type: Boolean,
        default: false
      },
      user_id:{
        type: [Number, String, null],
        default: null
      },
      user:{
        type: User,
        default: () => new User(null)
      }
    },
    data () {
      return {
        avatar: {
          type: '',
          color: 'primary',
          size: 'medium',
          icon: '',
          tile: false,
          user_id: null,
          resource: '',
        }
      }
    },
    mounted(){
      // set Avatar
      console.log('USER AVATAR', )
      if(!this.custom){
        // load user avatar
        console.log('USERAVATAR this.loadedUser.avatar() ', this.loadedUser.avatar() )
        this.avatar = this.loadedUser.avatar()[0]
      }else{
        // load from props
        this.avatar = this.loadedAvatar
      }
    },  
    computed:{
      avatarBindings() {
        const bindings = {
          'color': '',
          'size': '',
          'icon': '',
          'tile': '',
        };
        
        if(this.avatar.type == 'default' || this.avatar.type == 'initials'){
            bindings['color'] = 'secondary';
        }

        bindings['size'] = this.getSize(this.avatar.size);
        bindings['icon'] = true;
        bindings['tile'] = this.avatar.tile;

        return bindings;
      },
      loadedMicroserviceUrl() {
        return appData.microservice.url
      },
      loadedSize() {
        return this.size
      },
      loadedAvatar() {
        return {
          type: this.loadedType,
          color: 'primary',
          size: 'medium',
          icon: true,
          tile: this.loadedTile,
          user_id: this.loadedUserId,
          resource: this.loadedResource,
        };
      },
      loadedTile() {
        return this.tile;
      },
      loadedType() {
        return this.type;
      },
      loadedUser() {
        return this.user;
      },
      loadedSrc() {
        return this.src;
      },
      loadedInitials() {
        return this.initials;
      },
      loadedUserId() {
        return this.user_id;
      },
      loadedResource() {
        return this.resource;
      },
    },
    methods:{
      getSize(size) {
        if(this.size == 'small'){
          return 26
        }
        if(this.size == 'medium'){
          return 56
        }
        if(this.size == 'large'){
          return 100
        }
        if(this.size == 'x-large'){
          return 128
        }
        return 56;
      },
      getIconSize(size) {
        if(this.size == 'small'){
          return 24
        }
        if(this.size == 'medium'){
          return 54
        }
        if(this.size == 'large'){
          return 98
        }
        if(this.size == 'x-large'){
          return 124
        }
        return 54;
      },
      getTextSize(size) {
        if(this.size == 'small'){
          return 'title-1'
        }
        if(this.size == 'medium'){
          return 'title-3'
        }
        if(this.size == 'large'){
          return 'title-4'
        }
        if(this.size == 'x-large'){
          return 'title-5'
        }
        return 'title-2';
      },
      showImage() {
        if(this.loadedType == 'avatar'){
          return true
        }
        return false
      },
      showSpan() {
        if(this.loadedType == 'initials'){
          return true
        }
        return false
      },
      showIcon() {
        if(this.loadedType == 'icon'){
          return true
        }
        return false
      }
    }
};
</script>
