import { AxiosReturn } from './AxiosReturn';

/**
 *  Server Response interface for handling responses
 */
 export interface SResponses {
    // HTTP Status code
    status: number;
    // HTTP Status Text
    statusText: string;
    // Request Object
    request: object;
    // Headers Object
    headers: object;
    // Data Object
    data: AxiosReturn|null;
    // Config Object
    config: object;

}