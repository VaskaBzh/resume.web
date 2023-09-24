import { ref } from 'vue'

export const messageNote = ref('')
export const titleNote = ref('')
export const isGreen = ref(true)
export const openNotification = (state, title, text ) => {
  messageNote.value = text;
  titleNote.value = title;
  isGreen.value = state
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