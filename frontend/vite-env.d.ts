interface ImportMetaEnv {
  readonly VITE_API_CSRF_TOKEN_PATH: string;
  readonly VITE_API_MODELS_PATH: string;
  readonly VITE_API_CHAT_PATH: string;
}

interface ImportMeta {
  readonly env: ImportMetaEnv;
}
