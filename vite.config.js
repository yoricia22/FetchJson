import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
    },
  },
  server: {
    port: 8100,
    host: true, // This allows external access
    strictPort: true, // Don't try other ports if 8100 is taken
    cors: true, // Enable CORS
  }
}) 