import { defineConfig, loadEnv } from "vite";
import vue from "@vitejs/plugin-vue";
import vuetify from "vite-plugin-vuetify";

function loadEnvironmentVariables(mode: string) {
  const env = loadEnv(mode, process.cwd());
  if (!env) {
    throw new Error("No environment variables found. Make sure you are running docker");
  }
  return env;
}

function getServerConfig(env: any) {
  const port = Number(env.VITE_FRONTEND_PORT);
  if (isNaN(port)) {
    throw new Error("Invalid port number. Check your environment variables.");
  }
  return {
    host: true,
    port: port ?? 3454,
    watch: {
      usePolling: true
    }
  };
}

export default defineConfig(({ mode }) => {
  const env = loadEnvironmentVariables(mode);

  return {
    base: './',
    server: getServerConfig(env),
    plugins: [vue(), vuetify({ autoImport: true })],
    resolve: {
      dedupe: ["vue"],
    },
    build: {
      minify: 'terser',
    }
  }
});