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
        if (value !== this.EMPTY_ROW) {
            this.renderedValue = `<span class="column_value column_value-copy" data-copy="${value}">
                <span class="column_value_text"> ${value} </span>
                <svg fill="none" height="16" viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.3339 6.00016C11.3323 4.02877 11.3025 3.00764 10.7287 2.30845C10.6179 2.17342 10.4941 2.04961 10.359 1.9388C9.62147 1.3335 8.52564 1.3335 6.33399 1.3335C4.14233 1.3335 3.0465 1.3335 2.30894 1.9388C2.17391 2.04961 2.0501 2.17342 1.93929 2.30845C1.33398 3.04601 1.33398 4.14184 1.33398 6.3335C1.33398 8.52515 1.33398 9.62098 1.93929 10.3585C2.0501 10.4936 2.17391 10.6174 2.30894 10.7282C3.00812 11.302 4.02926 11.3319 6.00065 11.3334M10.0006 14.6668H10.6672C12.5528 14.6668 13.4956 14.6668 14.0814 14.081C14.6672 13.4953 14.6672 12.5524 14.6672 10.6668V10.0002C14.6672 8.11455 14.6672 7.17174 14.0814 6.58595C13.4956 6.00016 12.5528 6.00016 10.6672 6.00016H10.0006C8.11494 6.00016 7.17213 6.00016 6.58634 6.58595C6.00055 7.17174 6.00055 8.11454 6.00055 10.0002V10.6668C6.00055 12.5524 6.00055 13.4953 6.58634 14.081C7.17213 14.6668 8.11494 14.6668 10.0006 14.6668Z" stroke="#53B1FD" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>`;
        }
    }

    getCuttedWallet(wallet) {
        let cuttedWallet = "-";

        if (wallet) {
            cuttedWallet =
                wallet.substr(0, 4) +
                "..." +
                wallet.substr(wallet.length - 4, wallet.length);
        }

        return cuttedWallet;
    }

    cutCopyContent(value) {
        if (value !== this.EMPTY_ROW) {
            this.renderedValue = `<span class="column_value column_value-copy" data-copy="${value}">
                <span class="column_value_text"> ${this.getCuttedWallet(
                    value
                )} </span>

                <svg fill="none" height="16" viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.3339 6.00016C11.3323 4.02877 11.3025 3.00764 10.7287 2.30845C10.6179 2.17342 10.4941 2.04961 10.359 1.9388C9.62147 1.3335 8.52564 1.3335 6.33399 1.3335C4.14233 1.3335 3.0465 1.3335 2.30894 1.9388C2.17391 2.04961 2.0501 2.17342 1.93929 2.30845C1.33398 3.04601 1.33398 4.14184 1.33398 6.3335C1.33398 8.52515 1.33398 9.62098 1.93929 10.3585C2.0501 10.4936 2.17391 10.6174 2.30894 10.7282C3.00812 11.302 4.02926 11.3319 6.00065 11.3334M10.0006 14.6668H10.6672C12.5528 14.6668 13.4956 14.6668 14.0814 14.081C14.6672 13.4953 14.6672 12.5524 14.6672 10.6668V10.0002C14.6672 8.11455 14.6672 7.17174 14.0814 6.58595C13.4956 6.00016 12.5528 6.00016 10.6672 6.00016H10.0006C8.11494 6.00016 7.17213 6.00016 6.58634 6.58595C6.00055 7.17174 6.00055 8.11454 6.00055 10.0002V10.6668C6.00055 12.5524 6.00055 13.4953 6.58634 14.081C7.17213 14.6668 8.11494 14.6668 10.0006 14.6668Z" stroke="#53B1FD" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>`;
        }
    }

    statusRender(value, classModificator) {
        this.renderedValue = `<span class="column_value column_value-status column_value-status-${classModificator}">
            ${value}
        </span>`;
    }
}
