export class SliderService {
    constructor(meta) {
        this.meta = meta;
        this.saveTable = {};

        this.haveMeta = false;
        this.links = [];
        this.activeLink = -1;
    }

    getMeta(meta) {
        let bool = !!meta?.meta.to;
        if (bool) {
            this.haveMeta = bool;
        } else {
            setTimeout(() => {
                if (bool) {
                    this.haveMeta = bool;
                }
            }, 200);
        }

        return this;
    }

    metaProcess(newMeta) {
        if (newMeta?.meta.links) {
            this.links = newValue?.meta.links;
            this.service.dropButtonLinks();
            let lastIndex = Number(
                this.links[Object.values(this.links).length - 1].label
            );
            if (lastIndex > 9) {
                let index = this.service.activeLink?.label ?? 1;
                index = Number(index);
                this.service.setLinks(index, lastIndex);
            }
        }

        return this;
    }

    cacheTable(meta) {
        if (meta?.meta) {
            this.saveTable = this.table;
        }
    }

    validateRowsNumber(newValue, oldValue) {
        const regex = /^[0-9]*\.?[0-9]*$/;

        return (
                regex.test(newValue) &&
                newValue <= 100 &&
                newValue > 0
            )
                ? newValue
                : oldValue;
    }

    setActiveLink(linksArray) {
        this.activeLink = linksArray.filter((el, i) => {
            if (el.active) {
                return i;
            }
        })[0];
    }

    mapLinks(numStart, numEnd) {
        return this.links.filter((link, i) => {
            if (i >= numStart && i <= numEnd) return link;
        });
    }

    dropButtonLinks() {
        this.links.splice(0, 1);
        this.links.splice(this.links.length - 1, 1);
    }

    dropLinks() {
        this.links = [];
    }

    setLinks(index, lastIndex) {
        this.dropLinks();

        let links = [];
        if (index <= 4) {
            links = links.concat(
                this.mapLinks(0, 4),
                ["..."],
                this.mapLinks(lastIndex - 2, lastIndex)
            );
        }
        if (index > 4 && index <= lastIndex - 5) {
            links = links.concat(
                this.mapLinks(0, 3),
                ["..."],
                this.mapLinks(index - 2, index),
                ["..."],
                this.mapLinks(lastIndex - 2, lastIndex)
            );
        }
        if (index > lastIndex - 5 && index <= lastIndex) {
            links = links.concat(
                this.mapLinks(0, 3),
                ["..."],
                this.mapLinks(lastIndex - 5, lastIndex)
            );
        }

        this.links = [
            ...links
        ];
    }
}
