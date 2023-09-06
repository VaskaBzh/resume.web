export class ReferralStatsCards {
    constructor(cardValue) {
        this.interval = null;

        this.startValue = null;
        this.satoshi = null;
        this.startValue = null;
        this.cardValue = cardValue;
        this.intervalStep = null;

        this.htmlCard = null;
    }

    setHtmlCard(htmlCard) {
        this.htmlCard = htmlCard;
    }

    dropInterval() {
        clearInterval(this.interval);
    }

    dropCardValue() {
        const baseZeroValue = 0;

        this.cardValue = baseZeroValue;
    }

    getIntervalStep() {
        const secondInMillisecond = 1000;

        this.intervalStep = secondInMillisecond / this.satoshi
    }

    setBaseCardValue(newValue) {
        const remains = 0;
        const spliter = 1;
        const bitcoinMultiplier = 100000000;
        const bitcoinValueLength = 8;

        const condition = newValue % spliter === remains;

        const bitcoinUnit = " BTC";

        this.cardValue =
            condition
                ? this.getPlusedValue(this.startValue)
                : (this.getPlusedValue(this.startValue) / bitcoinMultiplier).toFixed(bitcoinValueLength) + bitcoinUnit;
    }

    getPlusedValue(value) {
        return value + 1;
    }

    setHtmlCardWidth(width) {
        this.htmlCard.style.width = width + "px";
    }

    getSatoshi(value) {
        const bitcoinMultiplier = 10000000;

        const remains = 0;
        const spliter = 1;

        const condition = value % spliter === remains;

        this.satoshi =
            condition
                ? value
                : value * bitcoinMultiplier;
    }

    getStartValue(value) {
        const baseValue = 0;

        this.startValue = Number(value) || baseValue;
    }

    cardsIndex(newValue, oldValue) {
        const baseZeroValue = 0;

        if (Number(oldValue) === baseZeroValue) {
            this.setHtmlCardWidth(this.htmlCard.offsetWidth);

            this.getStartValue(oldValue);
            this.getSatoshi(newValue);
            this.getIntervalStep();

            this.setBaseCardValue(newValue);

            this.setInterval(newValue);

            setTimeout(() => {
                this.setHtmlCardWidth(this.htmlCard.scrollWidth);
            }, 300)
        } else {
            this.dropInterval();
            this.dropCardValue();
        }
    }

    setInterval(newValue) {
        this.interval = setInterval(() => {
            this.intervalIndex(newValue);
        }, this.intervalStep);
    }

    intervalIndex(newValue) {
        if (this.startValue <= this.satoshi && this.startValue > 0) {
            this.setBaseCardValue(newValue);
        } else if (this.startValue > this.satoshi) {
            this.dropInterval();
        }
        this.startValuePlus();
    }

    startValuePlus() {
        this.startValue = this.startValue + 1;
    }
}
