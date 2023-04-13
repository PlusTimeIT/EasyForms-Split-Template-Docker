import { ServerCall } from './ServerCall';
import { User } from './User';

/**
 * Contact Request Class for handling all contact requests
 */
export class ContactRequest {
    // Users ID
    public id: number = 0;
    // The Requested User
    public user: User = new User(null);
    // The Users First Name
    public requester: User = new User(null);
    // The Users Id
    public user_id: number = 0;
    // The Requesters Id
    public requester_id: number = 0;
    // The Requesters Message
    public message: string = '';
    // The Contact Request Status
    public status: string = '';
    // When a Contact Request was created
    public created_at: string = '';
    // When a Contact Request was soft deleted
    public deleted_at: string = '';
    // When a Contact Request was last updated
    public updated_at: string = '';

    
    constructor(contactRequest: object | null ) {
        this.setContactRequest(contactRequest);
    }

    public toJson()
    {
        return JSON.stringify(this);
    }

    // Set User
    public setContactRequest(contactRequest: object | null )
    {
        if(contactRequest !== null && contactRequest !== undefined){
            for (const [key, value] of Object.entries(contactRequest)) {
                    let assignedValue = value;
                    let assignedKey = key;

                    if(assignedKey == 'user' || assignedKey == 'requester' ){
                        assignedValue = new User(assignedValue);
                    }

                    this[assignedKey as keyof typeof this]  = assignedValue
            }
            return this;
        }
        this.setDefaults();
        return this;
    }

    // Logout
    public setDefaults(): void
    {
        this.id = 0;
        this.status = '';
        this.user = new User(null);
        this.requester = new User(null);
        this.user_id = 0;
        this.message = '';
        this.status = '';
        this.created_at = '';
        this.deleted_at = '';
        this.updated_at = '';
    }

     // Return Status Chip color for User
    public returnStatusChipColor(): string{
        // show confirm dialog  
        if(this.status == 'pending'){
            return 'info';
        }else if(this.status == 'accepted'){
            return 'success';    
        }else if(this.status == 'rejected'){
            return 'error';   
        }else if(this.status == 'archived'){
            return 'warning';   
        }else if(this.status == 'cancelled'){
            return 'accent';     
        }else{
            // not known
            return 'secondary'; 
        }
        
    }
}