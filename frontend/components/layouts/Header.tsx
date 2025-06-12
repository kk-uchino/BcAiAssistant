import { colors } from "@/styles/variables";
import styled from "styled-components";

export default function Header({ children }: { children: React.ReactNode }) {
  return <Container>{children}</Container>;
}

const Container = styled.div`
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-bottom: 16px;

  a {
    color: ${colors.green};
    text-decoration: none;
    cursor: pointer;
  }
`;
