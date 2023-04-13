import { reactive } from 'vue'
import {AES, enc}from 'crypto-js';

export const appData = reactive({
    mainLoader: true,
    currentLayout: null,
    microservice: { 
        url: 'http://localhost:80',
        forms: 'http://localhost:80/axios'
    },
    setMainLoader(display){
        this.mainLoader = display;
    },
    setLayout(layout){
        this.currentLayout = layout
        this.setMainLoader(false)
    },
    setLocal: function(name, value) {
        const encryptedObject = AES.encrypt(JSON.stringify(value),'oh-store'); 
        window.setLocal(name, encryptedObject) 
    },
    getLocal: function(name) { 
        if(window.getLocal(name) == null || window.getLocal(name) == undefined){
            return null
        }
        const decrypted2 = AES.decrypt(window.getLocal(name), 'oh-store');
        const decryptedObject = decrypted2.toString(enc.Utf8);
        return decryptedObject; 
    },
    deleteLocal: function(name) { window.deleteLocal(name); },
})

