import { fileURLToPath, URL } from "node:url";
import { defineConfig, loadEnv } from "vite";

// https://vitejs.dev/config/
export default defineConfig(({ mode }) => {
  const { VITE_APP_BASE } = loadEnv(mode, process.cwd());

  return {
    base: Boolean(VITE_APP_BASE) ? `${VITE_APP_BASE}` : undefined,
    esbuild: {
      supported: {
        "top-level-await": true, //browsers can handle top-level-await features
      },
    },
    build: {
      // genera el archivo .vite/manifest.json en outDir
      manifest: true,
      emptyOutDir: true,
      rollupOptions: {
        // sobreescribe la entrada por defecto .html
        input: {
          "index/app": "./assets/index/index.js",
          "home/app": "./assets/home/index.js",
          "activar/app": "./assets/activar-tarjeta/index.js",
          "forgot/app": "./assets/forgot/index.js",
          "beneficiarios/app": "./assets/beneficiarios/index.js",
          "agenda/app": "./assets/agenda/index.js",
          "profile/app": "./assets/profile/index.js",
          "citas/app": "./assets/mis-citas/index.js",
          "login/app": "./assets/login/index.js",
          "registro/app": "./assets/registro/index.js",
          "planes/app": "./assets/planes/index.js",
        },
      },
    },
    resolve: {
      alias: {
        "@": fileURLToPath(new URL("./assets", import.meta.url)),
      },
    },
  };
});
