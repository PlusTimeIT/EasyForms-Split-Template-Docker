import { ServerResponse } from './ServerResponse';
/**
 * ServerCall
 */
 export class ServerCall {

    static async request(type: string, endpoint: string, data: any = null) : Promise<ServerResponse>{
        const call = await window.axios[type](endpoint, data)
        return new ServerResponse(call);
    }

}