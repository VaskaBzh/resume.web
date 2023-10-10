export class PageService {
    constructor() {
        this.page_title = "";
    }

    setPageTitle(title) {
        this.page_title = title;

        return this;
    }

    setDocumentTitle() {
        document.title = this.page_title;

        return this;
    }

    titleProcess(title) {
        this.setPageTitle(title)
            .setDocumentTitle();
    }
}
