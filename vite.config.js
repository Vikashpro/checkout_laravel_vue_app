import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import dotenv from 'dotenv';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            config: () => {
                const env = dotenv.config({ path: '../.env' }).parsed;
                return { env };
              },
        }),
        vue({
            template: {
                base:null,
                includeAbsolute:false
            }
            })
            
    ],
}); 
