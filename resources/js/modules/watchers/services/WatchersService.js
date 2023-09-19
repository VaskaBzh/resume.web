import { MetaTableService } from "@/modules/common/services/MetaTableService";

export class WatchersService extends MetaTableService {
    constructor() {
        this.blocks = [];
    }

    setBlocks(newBlocks) {
        this.blocks = [
            ...newBlocks
        ]
    }

    dropBlocks() {
        this.blocks = []
    }

    fetch(page = 1, per_page = 10) {

    }

    async index() {

    }
}
