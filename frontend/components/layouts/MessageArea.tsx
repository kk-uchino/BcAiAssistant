import ButtonMessage from "@/components/messages/ButtonMessage";
import TextMessage from "@/components/messages/TextMessage";
import { useMessageStore } from "@/stores/messageStore";
import { useEffect, useRef } from "react";
import styled from "styled-components";

export default function MessageArea() {
  const { messages } = useMessageStore();

  const endOfMessages = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (endOfMessages.current) {
      endOfMessages.current.scrollIntoView({ behavior: "smooth" });
    }
  }, [messages]);

  return (
    <Container>
      {messages?.map((message, index) => {
        if (message.parts === "text") {
          return <TextMessage key={index} message={message} />;
        } else if (message.parts === "button") {
          return <ButtonMessage key={index} message={message} />;
        }
      })}
      <div ref={endOfMessages} />
    </Container>
  );
}

const Container = styled.div`
  display: flex;
  flex-direction: column;
  gap: 14px;
`;
