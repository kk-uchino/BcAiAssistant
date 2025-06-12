import { create } from "zustand";

type Store = {
  isOpenChatModal: boolean;
  openChatModal(): void;
  closeChatModal(): void;
};

export const useChatModalStore = create<Store>((set) => ({
  isOpenChatModal: false,
  openChatModal: () => set({ isOpenChatModal: true }),
  closeChatModal: () => set({ isOpenChatModal: false }),
}));
