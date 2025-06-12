import ChatButton from "@/components/ChatButton";
import ChatModal from "@/components/ChatModal";
import PreviewModal from "@/components/PreviewModal";
import { useChatModalStore } from "@/stores/chatModalStore";
import { useChatStore } from "@/stores/chatStore";
import { usePreviewModalStore } from "@/stores/previewModalStore";
import { useEffect } from "react";
import styled from "styled-components";

export default function BcAiAssistant() {
  const { isOpenChatModal } = useChatModalStore();
  const { isOpenPreviewModal } = usePreviewModalStore();
  const { setModels } = useChatStore();

  useEffect(() => {
    setModels();
  }, []);

  return (
    <Container>
      {isOpenChatModal ? <ChatModal /> : <ChatButton />}
      {isOpenPreviewModal && <PreviewModal />}
    </Container>
  );
}

const Container = styled.div`
  position: fixed;
  right: 20px;
  bottom: 20px;
  z-index: 9999;
  font-size: 14px;
  letter-spacing: 0.02em;
  opacity: 0.98;
`;
