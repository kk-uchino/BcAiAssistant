import { create } from "zustand";

type Store = {
  isOpenPreviewModal: boolean;
  openPreviewModal(): void;
  closePreviewModal(): void;
};

export const usePreviewModalStore = create<Store>((set) => ({
  isOpenPreviewModal: false,
  openPreviewModal: () => set({ isOpenPreviewModal: true }),
  closePreviewModal: () => set({ isOpenPreviewModal: false }),
}));
