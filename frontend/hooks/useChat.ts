import { sendRequest } from "@/api/chat";
import { useChatStore } from "@/stores/chatStore";
import { useMessageStore } from "@/stores/messageStore";
import {
  AssistantButtonMessage,
  AssistantTextMessage,
  UserTextMessage,
} from "@/types/message";

export const useChat = () => {
  const { addMessage, popMessage } = useMessageStore();
  const { currentModel, previousResponseId, setPreviousResponseId } =
    useChatStore();

  const sendChatMessage = async (text?: string) => {
    if (text) {
      const userMessage: UserTextMessage = {
        sender: "user",
        parts: "text",
        message: text,
      };
      addMessage(userMessage);
    }

    const loadMessage: AssistantTextMessage = {
      sender: "assistant",
      parts: "text",
      message: "Loading...",
    };
    addMessage(loadMessage);

    const responseMessages: (AssistantTextMessage | AssistantButtonMessage)[] =
      [];
    try {
      const response = await sendRequest(
        currentModel,
        text,
        previousResponseId
      );
      responseMessages.push(...response.messages);
      if (response.options.responseId) {
        setPreviousResponseId(response.options.responseId);
      }
    } catch (error) {
      responseMessages.push({
        sender: "assistant",
        parts: "text",
        message: "リクエスト処理中にエラーが発生しました。",
      });
    } finally {
      popMessage();
      for (const message of responseMessages) {
        addMessage(message);
      }
    }
  };

  return { sendChatMessage };
};
