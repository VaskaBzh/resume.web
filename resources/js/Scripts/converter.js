import currency from "@/api/currency";

export class Converter {
    constructor(value, price) {
        this.value = value;
        this.price = price;
        this.rub = 0;
        this.usd = 0;
    }

    getDollar() {
        this.usd = this.value * this.price;
        return this.usd;
    }

    async getRuble() {
        let ruble = 0;
        await currency().then((res) => (ruble = res.data.rates.USD));
        await this.getDollar();

        this.rub = this.usd / ruble || 1;
    }

    async coverted() {
        await this.getRuble();

        return {
            BTC: this.value,
            rub: this.rub,
            usd: this.usd,
        };
    }
}
