import resolve from '@rollup/plugin-node-resolve'
import commonjs from '@rollup/plugin-commonjs'
import zip from 'rollup-plugin-zip'
import vue from 'rollup-plugin-vue'
import alias from 'rollup-plugin-alias'
import nodeGlobals from 'rollup-plugin-node-globals'
import postcss from 'rollup-plugin-postcss'
import { terser } from "rollup-plugin-terser";
import copy from 'rollup-plugin-copy2'
import del from 'rollup-plugin-delete'

import {
    chromeExtension,
    simpleReloader,
} from 'rollup-plugin-chrome-extension'
import fg from 'fast-glob';
const production = process.env.NODE_ENV === 'production'

export default {
    input: 'src/manifest.json',
    output: {
        dir: 'dist',
        format: 'esm',
    },
    plugins: [


        // always put chromeExtension() before other plugins
        chromeExtension(),
        
        // includes an automatic reloader in watch mode
        simpleReloader(),

        production && del({ targets: 'dist/*' }),

        del({ targets: 'dist/**/*.js' }),

        // replace import files
        alias({
            resolve: ['.jsx', '.js'],
            entries: {
                // vue$: 'vue/dist/vue.common.js',
            }
        }),

        vue({autoStyles: false, styleToImports: true}),

        postcss({
            plugins: []
        }),

        // resolves node modules
        resolve(),

        // converts libraries that use commonjs
        commonjs(),

        nodeGlobals(),

        // minimalize code
        production && terser(),

        copy({
            assets: [
                ['src/_locales/pl/messages.json', '_locales/pl/messages.json'],
            ]
        }),

        {
            name: 'watch-locales',
            async buildStart(){
                const files = await fg('src/_locales/**/*');
                for(let file of files){
                    this.addWatchFile(file);
                }
            }
        },

        // creates a zip to upload to the Chrome Web Store :)
        production && zip({dir: 'releases'}),

    ],
}
