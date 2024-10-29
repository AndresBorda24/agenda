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
        input: {
          "index/index.js": "./assets/index/index.js",
          "home/index.js": "./assets/home/index.js",
          "activar-tarjeta/index.js": "./assets/activar-tarjeta/index.js",
          "forgot/index.js": "./assets/forgot/index.js",
          "beneficiarios/index.js": "./assets/beneficiarios/index.js",
          "agenda/index.js": "./assets/agenda/index.js",
          "profile/index.js": "./assets/profile/index.js",
          "mis-citas/index.js": "./assets/mis-citas/index.js",
          "login/index.js": "./assets/login/index.js",
          "registro/index.js": "./assets/registro/index.js",
          "planes/index.js": "./assets/planes/index.js",
          "tramites/index.ts": "./assets/tramites/index.ts",
          "compras/index.ts": "./assets/compras/index.ts",
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
