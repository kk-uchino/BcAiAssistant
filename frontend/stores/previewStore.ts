import { create } from "zustand";

type Store = {
  preview: string | undefined;
  setPreview: (preview: string) => void;
  clearPreview: () => void;
};

export const usePreviewStore = create<Store>((set) => ({
  preview: undefined,
  setPreview: (preview) => set({ preview }),
  clearPreview: () => set({ preview: undefined }),
}));
