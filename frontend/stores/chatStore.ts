import { getModels } from "@/api/models";
import { create } from "zustand";

type Store = {
  models: string[];
  currentModel: string | undefined;
  previousResponseId: string | undefined;
  setModels: () => void;
  setCurrentModel: (model: string) => void;
  setPreviousResponseId: (setPreviousResponseId: string) => void;
  clearModels: () => void;
  clearCurrentModel: () => void;
  clearPreviousResponseId: () => void;
};

export const useChatStore = create<Store>((set) => ({
  models: [],
  currentModel: undefined,
  previousResponseId: undefined,
  setModels: async () => {
    const models = await getModels();
    set({
      models: models,
      currentModel: models[0] || undefined,
    });
  },
  setCurrentModel: (model) => set({ currentModel: model }),
  setPreviousResponseId: (setPreviousResponseId) =>
    set({ previousResponseId: setPreviousResponseId }),
  clearModels: () => set({ models: [] }),
  clearCurrentModel: () => set({ currentModel: undefined }),
  clearPreviousResponseId: () => set({ previousResponseId: undefined }),
}));
