import IconButton from "@/components/buttons/IconButton";
import Select from "@/components/inputs/Select";
import Textarea from "@/components/inputs/Textarea";
import Footer from "@/components/layouts/Footer";
import Header from "@/components/layouts/Header";
import MessageArea from "@/components/layouts/MessageArea";
import { useChat } from "@/hooks/useChat";
import { useChatModalStore } from "@/stores/chatModalStore";
import { useChatStore } from "@/stores/chatStore";
import { useMessageStore } from "@/stores/messageStore";
import { usePreviewModalStore } from "@/stores/previewModalStore";
import { usePreviewStore } from "@/stores/previewStore";
import { colors } from "@/styles/variables";
import { useState } from "react";
import styled from "styled-components";

export default function ChatModal() {
  const { closeChatModal } = useChatModalStore();
  const { closePreviewModal } = usePreviewModalStore();
  const { clearMessage, addMessage } = useMessageStore();
  const { clearPreview } = usePreviewStore();
  const { models, currentModel, setCurrentModel, clearPreviousResponseId } =
    useChatStore();
  const { sendChatMessage } = useChat();
  const [textareaKey, setTextareaKey] = useState(0);

  const formAction = async (formData: FormData) => {
    const text = formData.get("text") as string;

    if (!text) {
      addMessage({
        sender: "assistant",
        parts: "text",
        message: "メッセージを入力してください。",
      });
      return;
    }

    // テキストエリアの内容をクリアする
    setTextareaKey((prev) => prev + 1);

    sendChatMessage(text);
  };

  return (
    <Container>
      <Header>
        <a
          onClick={() => {
            closePreviewModal();
            clearPreview();
            clearMessage();
            clearPreviousResponseId();
            sendChatMessage();
          }}
        >
          最初から始める
        </a>
        <a
          onClick={() => {
            closeChatModal();
            closePreviewModal();
          }}
        >
          チャットを閉じる
        </a>
      </Header>
      <div className="message-area">
        <MessageArea />
      </div>
      <Footer>
        <form action={formAction}>
          <Textarea key={textareaKey} name="text" />
          <div className="button-area">
            <Select
              name="model"
              options={models}
              defaultValue={currentModel}
              onChange={(value) => setCurrentModel(value)}
            />
            <IconButton icon={["fas", "paper-plane"]} text="送信" />
          </div>
        </form>
      </Footer>
    </Container>
  );
}

const Container = styled.div`
  display: flex;
  flex-direction: column;
  width: 480px;
  height: 680px;
  padding: 16px;
  background-color: ${colors.white};
  border-radius: 16px;
  box-shadow: 0 2px 6px rgb(0 0 0 / 20%);

  .message-area {
    flex: 1;
    padding: 10px 0;
    overflow-y: auto;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: end;
    width: 100%;

    .button-area {
      display: flex;
      justify-content: space-between;
      width: 100%;
    }
  }
`;
