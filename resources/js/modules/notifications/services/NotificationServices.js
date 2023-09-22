import { ref } from 'vue'

export const messageNote = ref('')
export const titleNote = ref('')
export const openNotification = (text, title) => {
  messageNote.value = text;
  titleNote.value = title;

  // switch (title) {
  //   case 'addSub':
  //     titleNote.value = ''
  //     break;
  //   case 'addSub':
  //     titleNote.value = ''
  //     break;
  //   case 'addSub':
  //     titleNote.value = ''
  //     break;

  // }
  setTimeout(() => {
    messageNote.value = '';
    titleNote.value = ''
  }, 6000);
}