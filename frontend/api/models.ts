import { get } from "@/api/client";

export type ModelsResponse = string[];

export async function getModels(): Promise<ModelsResponse> {
  const response = await get<ModelsResponse>(
    import.meta.env.VITE_API_MODELS_PATH
  );

  return response;
}
