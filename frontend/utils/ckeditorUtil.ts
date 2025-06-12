declare global {
  interface Window {
    CKEDITOR: any;
  }
}

export const getData = (name: string): string => {
  const editor = window.CKEDITOR.instances[name];
  return editor.getData();
};

export const setData = (name: string, text: string): void => {
  const editor = window.CKEDITOR.instances[name];
  editor.setData(text);
};
