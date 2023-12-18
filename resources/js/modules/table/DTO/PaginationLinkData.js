export class PaginationLinkData {
    constructor(paginationRecord) {
        this.links = paginationRecord.url;
        this.label = paginationRecord.label;
        this.isActive = paginationRecord.active;
    }
}
