import { colors } from "@/styles/variables";
import { AssistantTextMessage, UserTextMessage } from "@/types";
import styled from "styled-components";

interface Props {
  message: AssistantTextMessage | UserTextMessage;
}

export default function TextMessage({ message }: Props) {
  return (
    <Container className={message.sender}>
      <div className="text-message">{message.message}</div>
    </Container>
  );
}

const Container = styled.div`
  .text-message {
    display: inline-block;
    max-width: 80%;
    padding: 14px 16px;
    line-height: 1.5;
    text-align: start;
    white-space: pre-wrap;
  }

  &.assistant {
    text-align: start;

    .text-message {
      background-color: ${colors.gray_100};
      border-radius: 20px 20px 20px 0;
    }
  }

  &.user {
    text-align: end;

    .text-message {
      background-color: ${colors.light_green};
      border-radius: 20px 20px 0;
    }
  }
`;
