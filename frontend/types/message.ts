export type AssistantTextMessage = {
  sender: "assistant";
  parts: "text";
  message: string;
};

export type AssistantButtonMessage = {
  sender: "assistant";
  parts: "button";
  message: string;
  action: "preview" | "reflect";
  argument?: string;
};

export type UserTextMessage = {
  sender: "user";
  parts: "text";
  message: string;
};
