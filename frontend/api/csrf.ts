import { get } from "@/api/client";

export async function sendCsrfTokenRequest(): Promise<string> {
  const response = await get<string>(import.meta.env.VITE_API_CSRF_TOKEN_PATH);
  return response;
}
