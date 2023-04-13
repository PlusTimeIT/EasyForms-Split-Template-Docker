import { Responses } from "../abstracts/Responses";
import { SResponses } from "../interfaces/SResponse";
import { AxiosReturn } from '../interfaces/AxiosReturn';

/**
 * Server Response Class for handling responses
 */
export class ServerResponse extends Responses {
    // HTTP Status code
    public status: number = 0;
    // HTTP Status Text
    public statusText: string = '';
    // Request Object
    public request: object;
    // Headers Object
    public headers: object;
    // Data Object
    public data: AxiosReturn|null = null;
    // Config Object
    public config: object;

    constructor(response: SResponses | null) {
        super(response);
        if(response != null) {
            this.status = response['status'];
            this.statusText = response['statusText'];
            this.request = response['request'];
            this.headers = response['headers'];
            this.data = response['data'];
            this.config = response['config'];
        }
    }


}