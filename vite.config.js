import { defineConfig } from 'vite'
import path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
    build: {
        // generate manifest.json in outDir
        manifest: true,
        rollupOptions: {
          // overwrite default .html entry
        //   input: '/src/main.js',
        input: {
            main: path.resolve(__dirname, 'src/main.js'),
            //nested: resolve(__dirname, 'nested/index.html'),
          }
        },
      },
  resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            //'~@fortawesome': path.resolve(__dirname, 'node_modules/@fortawesome'),
        }
    }
  
})
