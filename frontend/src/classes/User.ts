import { Note } from './Note';
import { ServerCall } from './ServerCall';
import { ServerResponse } from './ServerResponse';
import { UserMeta } from './UserMeta';
import { Avatar } from './Avatar';

/**
 * User Class for handling all users
 */
export class User {
    // User is authenticated
    protected authenticated: boolean = false;
    // Users ID
    protected id: number = 0;
    // Total count of new message Threads for the User
    protected new_message_count: number = 0;
    // Total count of new Contact Requests for the User
    protected new_contact_request_count: number = 0;
    // Array of the Users permissions
    protected permissions: Array<String> = [];
    // Array of the Users Meta data
    protected meta: Array<UserMeta> = [];
    // The Users Role
    protected role: string = 'guest';
    // The Users Status
    protected status: string = '';
    // The Users First Name
    protected first_name: string = '';
    // The Users Username
    protected username: string = '';
    // The Users Full Name
    protected full_name: string = '';
    // The Users Email
    protected email: string = '';
    // The Users Phone
    protected phone: string = '';
    // When a User was created
    protected created_at: string = '';
    // When a User was soft deleted
    protected deleted_at: string = '';
    // When a User had their email verified
    protected email_verified_at: string = '';
    // When a User was last logged in
    protected last_login_at: string = '';
    // When a User was last updated
    protected updated_at: string = '';

    constructor(user: object | null ) {
        this.setUser(user);
    }
    
    // Run auth check on user
    public async authCheck(): Promise<boolean> {        
        const response: ServerResponse = await ServerCall.request('get', '/auth/check/' + this.returnGuard());
        if (response.status === 200) {
            this.authenticated = true
            if(typeof response.data === 'object'){
                this.setUser(response.data)
            }
            return true;
        }
        this.authenticated = false
        return false;
    }

    public getId()
    {
        return this.id;
    }

    public getNotes()
    {
        return this.meta.filter(function(meta: UserMeta){
            return meta.getName() == 'note';
        }).map(function(meta: UserMeta){
            return (meta.toNote() as object)
        });
    }

    public getAvatar()
    {
        return this.meta.filter(function(meta: UserMeta){
            return meta.getName() == 'avatar';
        }).map(function(meta: UserMeta){
            return (meta.toAvatar() as object)
        });
    }

    public myAccountLink()
    {
        return  '/' + this.returnGuard() + '/my-account';
    }

    public avatar()
    {
        let avatar = this.getAvatar();
        console.log('this.meta', this.meta)
        console.log('getAvatar', avatar)
        if(avatar.length == 0){
          console.log('{user_id: this.getId()}', {user_id: this.id})
          return new Avatar({user_id: this.id})
        }
        return avatar;
    }

    public toJson()
    {
        return JSON.stringify(this);
    }

     // Save user to server
     public async saveUser(): Promise<boolean> {        
        const response: ServerResponse = await ServerCall.request('patch', '/axios/users/update/' + this.id, this.toJson());
        if (response.status === 200) {
            this.authenticated = true
            if(typeof response.data === 'object'){
                this.setUser(response.data)
            }
            return true;
        }
        this.authenticated = false
        return false;
    }
    
    // Populate User by Id
    public async populateUserById(user_id: number): Promise<User> {        
        const response: ServerResponse = await ServerCall.request('get', '/axios/users/show/' + user_id);
        if (response.status === 200) {
            this.authenticated = false
            if(typeof response.data === 'object' && typeof response.data.data === 'object'){
                this.setUser(response.data.data)
            }
            return this;
        }
        return this;
    }

    public returnGuard() : string {
        return (this.role === 'superAdmin') ? 'admin' : this.role;
    }

    // Set User
    public setUser(user: object | null )
    {
        if(user !== null && user !== undefined){
            for (const [key, value] of Object.entries(user)) {
                    let assignedValue = value;
                    let assignedKey = key;

                    if(assignedKey == 'type'){
                        assignedKey = 'role';
                    }
                    if(assignedKey == 'meta'){
                        assignedValue = value.map(function(meta: object){
                            return new UserMeta(meta);
                        });
                        console.log('assignedValue', assignedValue);
                    }
                    this[assignedKey as keyof typeof this]  = assignedValue
                
            }
            return this;
        }
        this.setDefaults();
        return this;
    }

    // Set User
    public setUserMeta(metaId: number, metaValue: any)
    {
        
        return this;
    }

    // Logout
    public setDefaults(): void
    {
        this.authenticated = false;
        this.id = 0;
        this.new_message_count = 0;
        this.new_contact_request_count = 0;
        this.permissions = [];
        this.meta = [];
        this.role = 'guest';
        this.status = '';
        this.first_name = '';
        this.username = '';
        this.full_name = '';
        this.email = '';
        this.phone = '';
        this.created_at = '';
        this.deleted_at = '';
        this.email_verified_at = '';
        this.last_login_at = '';
        this.updated_at = '';
    }

    // Logout
    public async logout(): Promise<boolean>
    {
        const response: ServerResponse = await ServerCall.request('get', '/auth/logout/' + this.returnGuard());
        if (response.status === 200) {
            return true;                 
        }
        return false;
    }

    // Return Layout for current User
    public returnLayout(layout: string | null): string | boolean
    {
        if(layout == 'GuestLayout'){
            return layout;
        }

        if(this.role == 'admin' || this.role == 'superAdmin'){
            return 'AdminLayout';
        }else if(this.role == 'user'){
            return 'UserLayout';
        }

        //should redirect to login.
        return false
    }

    // Return is current User Admin
    public isAdmin(): string | boolean
    {
        return (this.role == 'admin' || this.role == 'superAdmin')
    }

     // Return Status Chip color for User
    public returnStatusChipColor(): string{
        // show confirm dialog  
        if(this.status == 'pending'){
            return 'info';
        }else if(this.status == 'active'){
            return 'success';    
        }else if(this.status == 'inactive'){
            return 'warning';   
        }else if(this.status == 'archived'){
            return 'accent';     
        }else{
            // banned or not known
            return 'error'; 
        }
        
    }
}