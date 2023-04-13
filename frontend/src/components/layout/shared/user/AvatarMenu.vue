<template>
  <v-menu
    min-width="200px"
    rounded
    offset-y
  >   
    <template #activator="{ on: onMenu }">
      <v-tooltip bottom>
        <template #activator="{ on: onTooltip, attrs }">
          <v-btn
            icon
            small
            fab
            v-bind="attrs"
            v-on="{...onMenu, ...onTooltip}"
          >
            <user-avatar
              :user="loadedUser"
              :size="loadedSize"
            />
          </v-btn>
        </template>
        <span>{{ loadedTooltip }}</span>
      </v-tooltip>
    </template>
    <v-card tile>
      <v-list-item-content class="justify-center">
        <div class="mx-auto text-center">
          <user-avatar
            :user="loadedUser"
          />
          <h3 class="pt-3">{{ loadedUser.full_name }}</h3>
          <p class="text-caption pt-3">
            Username: {{ loadedUser.username }}
          </p>
          <v-divider class="my-3" />
          <v-btn
            depressed
            tile
            text
            :to="loadedUser.myAccountLink()"
          >
            Edit Account
          </v-btn>
          <v-divider class="my-3" />
          <btn-logout>
            Logout
          </btn-logout>
        </div>
      </v-list-item-content>
    </v-card>
  </v-menu>
</template>

<script>
import { User } from '../../../../classes/User';
import BtnLogout from '../../../buttons/BtnLogout.vue';
import UserAvatar from './Avatar.vue';

export default {
    name: 'UserAvatarMenu',
    components: {
        UserAvatar,
        BtnLogout
    },
    props: {
        user:{
            type: User,
            default: () => new User(null)
        },
        size:{
            type: String,
            default: 'medium'
        },
        tooltip:{
            type: Object,
            default: () => ({})
        }
    },
    data: () => ({

    }),
    computed:{
        loadedTooltip() {
            if(this.tooltip.contents != undefined && this.tooltip != null){
                return this.tooltip;
            }
            return 'User Profile'
        },
        loadedSize() {
            return this.size;
        },
        loadedUser() {
            return this.user;
        },
    },
    methods: {
        getAvatarImage() {
            if(this.getAvatarSrc !== null){
                //avatar found.
                return 'avatar';
            }
            if(this.getInitials !== '' && this.getInitials !== null){
                return 'initials';
            }
            return 'icon';
        },
    }
};
</script>