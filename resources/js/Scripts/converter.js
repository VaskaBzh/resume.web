import currency from "@/api/currency";

export class Converter {
    constructor(value, price) {
        this.btc = Number(value);
        this.price = price;
        this.rub = 0;
        this.usd = 0;
    }

    async getDollar() {
        this.usd = this.btc * this.price;
    }

    async getRuble() {
        let ruble = (await currency()).data.rates.USD || 0;

        this.rub = this.usd / (ruble || 1);
    }

    async convert() {
        await this.getDollar();
        await this.getRuble();

        this.rub = Number(this.rub).toFixed(2);
        this.usd = Number(this.usd).toFixed(2);
        this.btc = Number(this.btc).toFixed(8);
    }
}
