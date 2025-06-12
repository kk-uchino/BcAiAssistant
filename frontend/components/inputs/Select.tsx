import { colors } from "@/styles/variables";
import { useEffect, useState } from "react";
import styled from "styled-components";

interface Props {
  name: string;
  options: string[];
  defaultValue?: string | undefined;
  onChange?: (value: string) => void;
}

export default function Select({
  name,
  options,
  defaultValue,
  onChange,
}: Props) {
  const [selected, setSelected] = useState("");

  useEffect(() => {
    setSelected(defaultValue || options[0] || "");
  }, []);

  function handleChange(event: React.ChangeEvent<HTMLSelectElement>) {
    setSelected(event.target.value);

    if (onChange) {
      onChange(event.target.value);
    }
  }

  return (
    <StyledSelect name={name} value={selected} onChange={handleChange}>
      {options.map((option, index) => (
        <option key={index} value={option}>
          {option}
        </option>
      ))}
    </StyledSelect>
  );
}

const StyledSelect = styled.select`
  padding: 6px;
  outline: none;
  border: 1px solid ${colors.gray_200};
  border-radius: 4px;
`;
