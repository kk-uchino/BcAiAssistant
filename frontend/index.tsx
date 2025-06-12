import BcAiAssistant from "@/components/BcAiAssistant";
import { createRoot } from "react-dom/client";

document.addEventListener("DOMContentLoaded", () => {
  const body = document.querySelector("body");

  if (body) {
    const newElement = document.createElement("div");
    newElement.id = "react-root";
    body.appendChild(newElement);
    createRoot(newElement).render(<BcAiAssistant />);
  }
});
