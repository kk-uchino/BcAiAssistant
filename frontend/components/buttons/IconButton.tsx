import { colors } from "@/styles/variables";
import { IconProp, library } from "@fortawesome/fontawesome-svg-core";
import { far } from "@fortawesome/free-regular-svg-icons";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import styled from "styled-components";

library.add(far, fas);

interface Props {
  icon: IconProp;
  text: string;
  onClick?: () => void;
}

export default function IconButton({ icon, text, onClick }: Props) {
  return (
    <Button onClick={onClick}>
      <FontAwesomeIcon icon={icon} />
      <span>{text}</span>
    </Button>
  );
}

const Button = styled.button`
  display: flex;
  gap: 8px;
  align-items: center;
  padding: 8px 12px;
  font-weight: bold;
  color: ${colors.green};
  letter-spacing: 0.04em;
  cursor: pointer;
  background-color: ${colors.light_green};
  border: none;
  border-radius: 4px;
`;
