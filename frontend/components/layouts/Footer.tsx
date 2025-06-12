import styled from "styled-components";

export default function Footer({ children }: { children: React.ReactNode }) {
  return <Container>{children}</Container>;
}

const Container = styled.div`
  padding-top: 16px;
`;
