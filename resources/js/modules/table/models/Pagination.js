import { PaginationLinkData } from "@/modules/table/DTO/PaginationLinkData";

export class Pagination {
    FIRST_ELEMENT_INDEX = 0;
    CLEAR_URL_INDEX = 1;

    meta = null;
    links = null;

    pagination = null;
    prevLink = null;
    nextLink = null;

    setLinks() {
        const metaLinksLastIndex = this.meta.links.length - 1;

        this.links = this.meta.links.filter(
            (link, index) => index !== 0 && index !== metaLinksLastIndex
        );

        return this;
    }

    setMeta(newMetaData) {
        this.meta = newMetaData;

        return this;
    }

    setButtonsLinks() {
        const metaLinksLastIndex = this.meta.links.length - 1;

        this.prevLink = this.getClearUrl(
            this.meta.links[this.FIRST_ELEMENT_INDEX].url
        );
        this.nextLink = this.getClearUrl(
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
        if (url) {
            return url.split("v1/")[this.CLEAR_URL_INDEX];
        }

        return url;
    }

    paginationProcess(meta) {
        this.setMeta(meta).setButtonsLinks().setLinks().setPagination();
    }
}
