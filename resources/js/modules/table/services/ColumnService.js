export class ColumnService {
    constructor() {
        this.renderedValue = null;
    }

    setWorkersStats(value) {
        this.renderedValue = `
            <span class="column_value-worker column_value-worker-active">
                ${value.workers_count_active}
            </span>
            <span class="column_value column_value-worker">/</span>
            <span class="column_value-worker column_value-worker-unstable">
                ${value.workers_count_in_active}
            </span>`;
    }

    bitcoinFormat(value) {
        this.renderedValue = `${Number(value).toFixed(8)} BTC`;
    }
}
