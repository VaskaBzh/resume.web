export class ColumnService {
    EMPTY_ROW = "-";

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

    copyContent(value) {
        // value === this.EMPTY_ROW
        //     ? value
        //     :
        this.renderedValue = `<span class="column_value column_value-copy">
            ${value}
            <svg class="column_value_icon column_value_icon-copy" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.0487 6.00065C12.0472 4.02926 12.0173 3.00812 11.4435 2.30894C11.3327 2.17391 11.2089 2.0501 11.0739 1.93929C10.3363 1.33398 9.24048 1.33398 7.04883 1.33398C4.85717 1.33398 3.76135 1.33398 3.02378 1.93929C2.88876 2.0501 2.76495 2.17391 2.65413 2.30894C2.04883 3.0465 2.04883 4.14233 2.04883 6.33398C2.04883 8.52564 2.04883 9.62147 2.65413 10.359C2.76494 10.4941 2.88876 10.6179 3.02378 10.7287C3.72297 11.3025 4.7441 11.3323 6.7155 11.3339M10.7154 14.6673H11.3821C13.2677 14.6673 14.2105 14.6673 14.7963 14.0815C15.3821 13.4957 15.3821 12.5529 15.3821 10.6673V10.0007C15.3821 8.11503 15.3821 7.17222 14.7963 6.58644C14.2105 6.00065 13.2677 6.00065 11.3821 6.00065H10.7154C8.82978 6.00065 7.88697 6.00065 7.30118 6.58644C6.7154 7.17222 6.7154 8.11503 6.7154 10.0007V10.6673C6.7154 12.5529 6.7154 13.4957 7.30118 14.0815C7.88697 14.6673 8.82978 14.6673 10.7154 14.6673Z" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>`;
    }

    statusRender(value, translate) {
        this.renderedValue = `<span class="column_value column_value-status column_value-status-${value}">
            ${translate(value)}
        </span>`;
    }
}
