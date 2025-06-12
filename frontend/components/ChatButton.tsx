import { useChat } from "@/hooks/useChat";
import { useChatModalStore } from "@/stores/chatModalStore";
import { useMessageStore } from "@/stores/messageStore";
import { colors } from "@/styles/variables";
import styled from "styled-components";

export default function ChatButton() {
  const { openChatModal } = useChatModalStore();
  const { messages } = useMessageStore();
  const { sendChatMessage } = useChat();

  return (
    <Button
      onClick={() => {
        openChatModal();
        if (!messages) sendChatMessage();
      }}
    >
      <img src="/bc_ai_assistant/img/admin/ai_icon.svg" alt="" />
    </Button>
  );
}

const Button = styled.button`
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  color: ${colors.white};
  cursor: pointer;
  background-color: ${colors.light_green};
  border: none;
  border-radius: 6px;
  box-shadow: 0 2px 6px rgb(0 0 0 / 20%);

  img {
    filter: invert(71%) sepia(15%) saturate(6036%) hue-rotate(48deg)
      brightness(96%) contrast(52%);
  }
`;
