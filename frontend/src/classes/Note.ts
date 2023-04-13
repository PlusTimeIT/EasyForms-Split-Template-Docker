import { ServerCall } from './ServerCall';
import { ServerResponse } from './ServerResponse';
import { User } from './User';
import { UserMeta } from './UserMeta';

/**
 * Note Class for handling all user notes
 */
export class Note {
    // Notes id
    public id: number = 0;
    // Notes user Id
    public user_id: number = 0;
    // The Notes title
    public title: string = '';
    // Whether then note should be displayed
    public display: boolean = false;
    // The Notes Contents
    public contents: string = '';
    // The Creator of the Note
    public creator: User; 
    // When the Nte was created
    public created_at: string = ''; 
    // When the Note was last updated
    public updated_at: string = ''; 

    constructor(note: object | null ) {
        this.setNote(note);
    }

     // Set Note
     public setNote(note: object | null )
     {
         if(note !== null && note !== undefined){
             for (const [key, value] of Object.entries(note)) {
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
    
    public showDialog()
    {
        this.display = true;
    }
    
    public hideDialog()
    {
        this.display = false
    }

    // to UserMeta
    public toUserMeta(): UserMeta
    {
        const meta = { title: this.title, contents: this.contents, creator: this.creator };
        return new UserMeta({
            id: this.id,
            user_id: this.user_id,
            name: 'note',
            type: 'Object',
            value: meta
        })
    }

    // Set Defaults
    public setDefaults(): void
    {
        this.id = 0;
        this.user_id = 0;
        this.title = '';
        this.contents = '';
        this.creator = new User(null);
        this.created_at = '';
        this.updated_at = '';
    }

}