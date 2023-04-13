import axios from 'axios';
import {appData} from '../../mixins/store';

axios.defaults.withCredentials = true;

export default axios.create({
    baseURL: appData.microservice.url,
    headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
        "Accept": "application/json",
    }
});
