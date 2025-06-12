import { getData, setData } from "@/utils/ckeditorUtil";

const bodyEditorName = "ContentsTmp";

export const getBody = (): string => {
  return getData(bodyEditorName);
};

export const setBody = (text: string): void => {
  setData(bodyEditorName, text);
};
