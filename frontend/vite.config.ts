import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import vuetify from "vite-plugin-vuetify";

export default defineConfig(({ mode }) => {
  return {
    base: './',
    server: {
      host: true,
      port: 3454,
      watch: {
        usePolling: true
      }
    },
    plugins: [vue(), vuetify({ autoImport: true })],
    resolve: {
      dedupe: ["vue"],
    },
    build: {
      minify: 'terser',
    }
  }
});