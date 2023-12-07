import { PaginationLinkData } from "@/modules/table/DTO/PaginationLinkData";

export class Pagination {
    FIRST_ELEMENT_INDEX = 0;
    CLEAR_URL_INDEX = 1;

    perPage = null;
    page = null;

    meta = null;
    links = null;

    pagination = null;
    buttonPrev = null;
    buttonNext = null;

    setLinks() {
        const metaLinksLastIndex = this.meta.links.length - 1;

        this.links = this.meta.links.filter(
            (_, i) => i !== 0 && i !== metaLinksLastIndex
        );

        console.log(this.links);

        return this;
    }

    setMeta(newMetaData) {
        this.meta = newMetaData;

        return this;
    }

    setPage() {
        this.page = this.meta.current_page;

        return this;
    }

    setPerPage() {
        this.perPage = this.meta.per_page;

        return this;
    }

    setButtons() {
        const metaLinksLastIndex = this.meta.links.length - 1;

        this.buttonPrev = this.getClearUrl(
            this.meta.links[this.FIRST_ELEMENT_INDEX].url
        );
        this.buttonNext = this.getClearUrl(
            this.meta.links[metaLinksLastIndex].url
        );

        return this;
    }

    setPagination() {
        this.pagination = this.links.map(
            (link) => new PaginationLinkData(link)
        );

        return this;
    }

    getClearUrl(url) {
        return url.split("v1/")[this.CLEAR_URL_INDEX];
    }

    paginationProcess(meta) {
        this.setMeta(meta)
            .setButtons()
            .setPage()
            .setPerPage()
            .setLinks()
            .setPagination();
    }
}
