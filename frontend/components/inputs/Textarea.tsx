import { colors } from "@/styles/variables";
import { useEffect, useState } from "react";
import styled from "styled-components";

interface Props {
  name: string;
  defaultValue?: string | undefined;
  onChange?: (value: string) => void;
}

export default function Textarea({ name, defaultValue, onChange }: Props) {
  const [value, setValue] = useState("");

  useEffect(() => {
    setValue(defaultValue || "");
  }, []);

  function handleChange(event: React.ChangeEvent<HTMLTextAreaElement>) {
    setValue(event.target.value);

    if (onChange) {
      onChange(event.target.value);
    }
  }

  return (
    <StyledTextarea
      name={name}
      value={value}
      onChange={handleChange}
    ></StyledTextarea>
  );
}

const StyledTextarea = styled.textarea`
  width: 100%;
  height: 100px;
  padding: 8px;
  resize: none;
  outline: none;
  border: 1px solid ${colors.gray_200};
  border-radius: 4px;
`;
