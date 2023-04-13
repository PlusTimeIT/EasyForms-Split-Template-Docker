import { ServerCall } from './ServerCall';
import { ServerResponse } from './ServerResponse';
import { User } from './User';
import { Note } from './Note';
import { Avatar } from './Avatar';

/**
 * User Meta Class for handling all user meta data
 */
export class UserMeta {
    // User Meta Id
    protected id: number = 0;
    // User Meta user Id
    protected user_id: number = 0;
    // The type User Meta to cast
    protected type: string = '';
    // User Meta Name
    protected name: string = '';
    // The User Meta contents
    protected value: object|Array<any>|string|number|boolean|null;

    constructor(user_meta: object | null ) {
        this.setUserMeta(user_meta);
    }

     // Set user_meta
     public setUserMeta(user_meta: object | null )
     {
         if(user_meta !== null && user_meta !== undefined){
             for (const [key, value] of Object.entries(user_meta)) {
                this[key as keyof typeof this] = value
             }
             return this;
         }
         this.setDefaults();
         return this;
     }
   
    public getName(): string
    {
        return this.name;
    } 
   
    public getValue(): object|Array<any>|string|number|boolean|null
    {
        return this.value;
    } 
   
    public toJson()
    {
        return JSON.stringify(this);
    } 

    public castType()
    {
        if(typeof this.type == 'object' || Array.isArray(this.value)){
            this.value = JSON.parse(this.value);
        }
        return this;
    }

    public toNote()
    {
        if(typeof this.type == 'object' || Array.isArray(this.value)){
            this.value = JSON.parse(this.value);
        }
        return new Note({...this, ...this.value});
    }

    public toAvatar()
    {
        if(typeof this.type == 'object' || Array.isArray(this.value)){
            this.value = JSON.parse(this.value);
        }
        return new Avatar({...this, ...this.value});
    }

    // Set Defaults
    public setDefaults(): void
    {
        this.id = 0;
        this.user_id = 0;
        this.name = '';
        this.value = null;
    }

}