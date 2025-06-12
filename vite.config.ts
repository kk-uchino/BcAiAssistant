import react from "@vitejs/plugin-react";
import { resolve } from "path";
import { defineConfig } from "vite";
import tsconfigPaths from "vite-tsconfig-paths";

export default defineConfig({
  root: "./frontend",
  build: {
    outDir: "../webroot/js/admin",
    assetsDir: "",
    emptyOutDir: true,
    rollupOptions: {
      input: {
        app: resolve(__dirname, "frontend/index.tsx"),
      },
      output: {
        entryFileNames: `[name].js`,
        chunkFileNames: `[name].js`,
        assetFileNames: `[name].[ext]`,
      },
    },
  },
  server: {
    watch: {
      usePolling: true,
      interval: 1000,
    },
  },
  plugins: [react(), tsconfigPaths()],
});
