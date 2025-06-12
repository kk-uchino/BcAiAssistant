import { post } from "@/api/client";
import { AssistantButtonMessage, AssistantTextMessage } from "@/types/message";

export type Response = {
  messages: (AssistantTextMessage | AssistantButtonMessage)[];
  options: {
    responseId: string;
  };
};

export async function sendRequest(
  model?: string,
  text?: string,
  previousResponseId?: string
): Promise<Response> {
  const payload: {
    model?: string;
    text?: string;
    previousResponseId?: string;
  } = {};
  if (model) {
    payload.model = model;
  }
  if (text) {
    payload.text = text;
  }
  if (previousResponseId) {
    payload.previousResponseId = previousResponseId;
  }

  const response = await post<Response>(
    import.meta.env.VITE_API_CHAT_PATH,
    payload
  );

  return response;
}
