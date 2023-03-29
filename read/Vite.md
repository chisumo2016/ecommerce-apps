### MOVING LARAVEL MIX TO VITE 
    - Fast way to bundle the assest very quickly
    - Open laravel/breeze
            https://github.com/laravel/breeze/pull/154/files
            https://github.com/laravel/breeze/pull/154/files#diff-4d47e3169664208a73149d7dcf67edd3ce60f60bfecb8fb8bf53a2a8e9853ff5
            stubs/default/resources/js/app.js
                require('./bootstrap');
                import './bootstrap';
    -     2: https://github.com/laravel/breeze/pull/154/files#diff-4425b899a1d3aff9f13974ba89ed87e0bea64a4e413854d90995f384dd878612
                stubs/inertia-vue/resources/js/bootstrap.js
                 import _ from 'lodash';
                 window._ = _;

                import axios from 'axios';
                window.axios = axios;

                // import Pusher from 'pusher-js';
                // window.Pusher = Pusher;

            3: https://github.com/laravel/breeze/pull/158
                stubs/default/postcss.config.js
                    module.exports = {
                        plugins: {
                            tailwindcss: {},
                            autoprefixer: {},
                        },
                    };
                sstubs/inertia-common/resources/views/app.blade.php
                      @vite('resources/js/app.js')
                      @inertiaHead
                      <body class="font-sans antialiased">
                        @inertia
                      </body>
        4:  https://github.com/laravel/breeze/pull/158/files#diff-277efea675ec80797ab0e728f36de7be02c5558fb050e078b6097c8eb5983e98
                        stubs/inertia-vue/resources/js/app.js
                            import '../../css/admin/app.css';
                            import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
                            import { ZiggyVue } from '../../../vendor/tightenco/ziggy/dist/vue.m';
                
                            resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
                               .use(ZiggyVue, Ziggy)
                                .mount(el);
        5:  stubs/inertia-react/resources/js/bootstrap.js
                        key: import.meta.env.VITE_PUSHER_APP_KEY,
                        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,


        6: Open .ENV file
                   VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
                   VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

        7: stubs/inertia-vue/vite.config.js - on root
                import { defineConfig } from 'vite';
                import laravel from 'laravel-vite-plugin';
                import vue from '@vitejs/plugin-vue';
                export default defineConfig({
                        plugins: [
                            laravel({
                                input: ['resources/js/app.js]', // ['resources/js/admin/app.js]'
                                refresh: true
                     }),
                    vue({
                        template: {
                            transformAssetUrls: {
                                base: null,
                                    includeAbsolute: false,
                            },
                        },
                    }),
                    ],
                    resolve:{
                        alias:{
                            '@': '/resources/js/admin',
                        },
                    },
                });

        8: Remove & Install laravel-mix && webpack.mix.js webpack.config.js
            npm remove laravel-mix && rm webpack.mix.js webpack.config.js
            npm install --save-dev vite laravel-vite-plugin @vitejs/plugin-vue

        9: Laravel /Laravel github
                https://github.com/laravel/laravel

                . look for package.json
                    https://github.com/laravel/laravel/blob/10.x/package.json

        10 Run 
            composer update
            npm ruv dev
                      
                    
