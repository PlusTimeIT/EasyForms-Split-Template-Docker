import '@mdi/font/css/materialdesignicons.css';
import Vue from 'vue';
import Vuetify from 'vuetify/lib';
import delivereThemes from '@/plugins/vuetify/theme'
import minifyTheme from 'minify-css-string';


Vue.use(Vuetify);


const vuetify = new Vuetify({
    icons: {
        iconfont: 'mdi'
    },
    theme: {
        dark: false,
        themes: delivereThemes,
        options: { 
            customProperties: true,
            themeCache: {
                get: function () {
                   localStorage.getItem('oh-theme');
                },
                set: function (key, value) {
                    localStorage.setItem('oh-theme', value);
                }
            },
            minifyTheme ,
        },
    }
})

export default vuetify;
