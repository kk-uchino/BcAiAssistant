import { useMessageStore } from "@/stores/messageStore";
import { usePreviewModalStore } from "@/stores/previewModalStore";
import { usePreviewStore } from "@/stores/previewStore";
import { colors } from "@/styles/variables";
import { AssistantButtonMessage } from "@/types";
import { setBody as setBlogBody } from "@/utils/blogUtil";
import { setBody as setPageBody } from "@/utils/pageUtil";
import styled from "styled-components";

declare const aiAssistantContentType: any;

interface Props {
  message: AssistantButtonMessage;
}

export default function ButtonMessage({ message }: Props) {
  const { setPreview } = usePreviewStore();
  const { openPreviewModal } = usePreviewModalStore();
  const { addMessage } = useMessageStore();

  const handleButtonClick = (message: AssistantButtonMessage) => {
    switch (message.action) {
      case "preview":
        setPreview(message.argument ?? "");
        openPreviewModal();
        break;
      case "reflect":
        addMessage({
          sender: "user",
          parts: "text",
          message: message.message,
        });
        if (aiAssistantContentType === "Page") {
          setPageBody(message.argument ?? "");
        } else if (aiAssistantContentType === "BlogContent") {
          setBlogBody(message.argument ?? "");
        }
        addMessage({
          sender: "assistant",
          parts: "text",
          message: "エディタに反映しました。",
        });
        break;
    }
  };

  return (
    <Container className={message.sender}>
      {
        <button
          className="button-message"
          onClick={() => handleButtonClick(message)}
        >
          {message.message}
        </button>
      }
    </Container>
  );
}

const Container = styled.div`
  .button-message {
    max-width: 80%;
    padding: 12px 16px;
    line-height: 1.5;
    cursor: pointer;
    background-color: ${colors.gray_100};
    border: none;
    border-radius: 3px;
    box-shadow: 0 2px 4px rgb(0 0 0 / 30%);
  }

  &.assistant {
    text-align: start;

    .text-message {
      background-color: ${colors.gray_100};
    }
  }

  &.user {
    text-align: end;

    .text-message {
      background-color: ${colors.light_green};
    }
  }
`;
