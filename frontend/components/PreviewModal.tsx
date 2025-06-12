import Header from "@/components/layouts/Header";
import PreviewArea from "@/components/layouts/PreviewArea";
import { usePreviewModalStore } from "@/stores/previewModalStore";
import { usePreviewStore } from "@/stores/previewStore";
import { colors } from "@/styles/variables";
import styled from "styled-components";

export default function PreviewModal() {
  const { closePreviewModal } = usePreviewModalStore();
  const { clearPreview } = usePreviewStore();

  return (
    <Container>
      <Header>
        <span></span>
        <a
          onClick={() => {
            closePreviewModal();
            clearPreview();
          }}
        >
          閉じる
        </a>
      </Header>
      <PreviewArea />
    </Container>
  );
}

const Container = styled.div`
  position: absolute;
  top: 0;
  right: calc(480px + 1px);
  display: flex;
  flex-direction: column;
  width: 480px;
  height: 680px;
  padding: 16px;
  background-color: ${colors.white};
  border-radius: 16px;
  box-shadow: 0 2px 6px rgb(0 0 0 / 20%);
`;
