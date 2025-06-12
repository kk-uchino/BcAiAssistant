import { usePreviewStore } from "@/stores/previewStore";
import parse from "html-react-parser";
import styled from "styled-components";

export default function PreviewArea() {
  const { preview } = usePreviewStore();

  return <Container>{preview && parse(preview)}</Container>;
}

const Container = styled.div`
  padding: 16px 0;
  overflow-y: auto;
`;
