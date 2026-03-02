import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  plugins: [],
  base: process.env.NODE_ENV === 'production' ? '/wp-content/themes/easy-theme/dist/' : '/',
  build: {
    outDir: resolve(__dirname, 'dist'),
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: resolve(__dirname, 'src/js/main.js')
    }
  },
  server: {
    port: 5173,
    strictPort: true,
    hmr: {
      host: 'localhost',
    },
  },
});
