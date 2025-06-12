import { sendCsrfTokenRequest } from "@/api/csrf";
import axios from "axios";

const apiClient = axios.create({
  headers: {
    "Content-Type": "application/json",
  },
});

export async function get<T>(url: string): Promise<T> {
  const response = await apiClient.get(url);
  if (response.status !== 200) {
    throw new Error(response.statusText);
  }
  return response.data;
}

export async function post<T>(url: string, data: any): Promise<T> {
  const csrfToken = await sendCsrfTokenRequest();
  const response = await apiClient.post(url, data, {
    headers: {
      "X-CSRF-Token": csrfToken,
    },
    timeout: 60000,
  });
  if (response.status !== 200) {
    throw new Error(response.statusText);
  }
  return response.data;
}
