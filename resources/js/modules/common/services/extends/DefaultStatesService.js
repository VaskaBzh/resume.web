import store from "@/store";

export class DefaultStatesService {
    constructor() {
        this.isMobile = false;
        this.isDark = false;

        this.setDarkState();
        this.setIsMobileState();
    }

    setIsMobileState(newViewportWidth = store.getters.viewportWidth) {
        this.isMobile = newViewportWidth <= 767.98;

        return this;
    }

    setDarkState(isDarkState = store.getters.isDark) {
        this.isDark = isDarkState;

        return this;
    }
}
