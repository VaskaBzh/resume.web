export default class ThemeModel {
  constructor() {
      this.linkElement = this.setLink();

      this.theme = this.baseTheme();
  }

  baseTheme() {
      if (localStorage.getItem('theme'))
          return JSON.parse(localStorage.getItem('theme'));
      return 'dark';
  }

  createLink() {
      return document.createElement('link');
  }

  setLink() {
      return document.querySelector(`link[href='../scss/theme/${this.theme}-theme.css']`)
          || this.createLink();
  }
}