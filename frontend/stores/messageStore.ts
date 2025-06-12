import { create } from "zustand";
import {
  AssistantButtonMessage,
  AssistantTextMessage,
  UserTextMessage,
} from "../types";

type Store = {
  messages:
    | (AssistantTextMessage | AssistantButtonMessage | UserTextMessage)[]
    | undefined;
  addMessage: (
    message: AssistantTextMessage | AssistantButtonMessage | UserTextMessage
  ) => void;
  popMessage: () => void;
  clearMessage(): void;
};

export const useMessageStore = create<Store>((set) => ({
  messages: undefined,
  addMessage: (message) => {
    set((state) => ({
      messages: [...(state.messages || []), message],
    }));
  },
  popMessage: () =>
    set((state) => ({
      messages: state.messages ? state.messages.slice(0, -1) : undefined,
    })),
  clearMessage: () => set({ messages: undefined }),
}));
