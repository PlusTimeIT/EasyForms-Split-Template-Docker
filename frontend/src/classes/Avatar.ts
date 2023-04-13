import { ServerCall } from './ServerCall';
import { ServerResponse } from './ServerResponse';
import { User } from './User';
import { UserMeta } from './UserMeta';

/**
 * Avatar Class for handling all user avatars
 */
export class Avatar {
    // Avatar id
    public id: number = 0;
    // Avatar user Id
    public user_id: number = 0;
    // The Avatar type either default (icon), initials (from User data), or image
    public type: string = 'default';
    // The Avatar size
    public size: string = 'medium';
    // The Avatar isa tile display
    public tile: boolean = false;
    // The Avatar colour
    public color: string = 'primary';
    // Avatar Resource either initials or URL
    public resource: string = '';
    // When the Avatar was created
    public created_at: string = ''; 
    // When the Avatar was last updated
    public updated_at: string = ''; 

    constructor(note: object | null ) {
        this.setAvatar(note);
    }

     // Set Avatar
     public setAvatar(avatar: object | null )
     {
         if(avatar !== null && avatar !== undefined){
             for (const [key, value] of Object.entries(avatar)) {
                this[key as keyof typeof this]  = value
             }
             return this;
         }
         this.setDefaults();
         return this;
     }
    
    public toJson()
    {
        return JSON.stringify(this);
    }

    // to UserMeta
    public toUserMeta(): UserMeta
    {
        const meta = { type: this.type, resource: this.resource};
        return new UserMeta({
            id: this.id,
            user_id: this.user_id,
            name: 'avatar',
            type: 'Object',
            value: meta
        })
    }

    // Set Defaults
    public setDefaults(): void
    {
        this.id = 0;
        this.user_id = 0;
        this.type = 'default';
        this.size = 'medium';
        this.color = 'primary';
        this.tile = false;
        this.resource = '';
        this.created_at = '';
        this.updated_at = '';
    }

}