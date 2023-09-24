import ThemeModel from "../Models/ThemeModel";

export default class ThemeService {
    constructor() {
        this.ThemeModel = new ThemeModel();

        this.linkElement = this.ThemeModel.linkElement;
    }

    setAttributes(themeFile) {
        this.linkElement.setAttribute("rel", "stylesheet");
        this.linkElement.setAttribute("href", themeFile);
    }

    setTheme(theme = this.ThemeModel.theme) {
        localStorage.setItem("theme", JSON.stringify(theme));
    }

    createLink() {
        return document.createElement("link");
    }

    toggleTheme(theme) {
        const themeFile = new URL(
            `/resources/scss/theme/${theme}-theme.css`,
            import.meta.url
        );

        if (!this.linkElement) {
            this.linkElement = this.createLink();
        }

        this.setAttributes(themeFile);
        this.setTheme(theme);

        if (this.linkElement) {
            document.head.appendChild(this.linkElement);
        }
    }
}
