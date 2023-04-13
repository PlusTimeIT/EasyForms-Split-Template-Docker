import { SResponses } from '../interfaces/SResponse';

/**
 *  Abstract class for handling responses
 */
 export abstract class Responses {
    // HTTP Status code
    status: number;
    // HTTP Status Text
    statusText: string;
    // Request Object
    request: object;
    // Headers Object
    headers: object;
    // Data Object
    data: string|number|object|Array<string>|null;
    // Config Object
    config: object;

    constructor(response: SResponses | null) {
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