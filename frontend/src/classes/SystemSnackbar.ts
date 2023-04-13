/**
 * System Snackbar for handling system events.
 */
export class SystemSnackbar {

    protected value: boolean = false;
    protected text: boolean = false;
    protected dark: boolean = true;
    protected outlined: boolean = false;
    protected rounded: boolean = false;
    protected right: boolean = true;
    protected tile: boolean = true;
    protected bottom: boolean = true;
    protected top: boolean = false;
    protected shaped: boolean = false;
    protected multi_line: boolean = false;
    protected message: string = '';
    protected color: string = 'accent';
    protected class: string = 'mr-3 mb-12';
    protected transition: string = 'fade';
    protected timeout: number = 5000;
    protected id: number = 0;

    constructor() {}
    
    public checkSnackBars():void  {
        // get Snackbars from server
    }

    // Hide Snackbar
    public hide(): void  {
        this.value = false;
    }

    // Show Snackbar
    public show(): void  {
        this.value = true;
    }

}