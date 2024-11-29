/// <reference types="vite/client" />

interface ImportMetaEnv {
    VITE_APP_ENV: string;
    VITE_APP_API: string;
    VITE_APP_BASE: string;
    VITE_APP_URL: string;
    VITE_FOX_API: string;
    VITE_FOX_API_EXTERNA: string;
}

interface ImportMeta {
  readonly env: ImportMetaEnv
}
