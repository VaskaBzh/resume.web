import { DefaultSubsService } from "./DefaultSubsService";
import { HashrateUnitEnum } from "../enums/HashrateUnitEnum";

export class GraphDataService extends DefaultSubsService {
    constructor(titles, offset = 96) {
        super();
        this.titles = titles;
        this.offset = offset;

        this.graph = {};
        this.records = [];

        this.translate = null;
    }

    setTranslate(translate) {
        this.translate = translate;
    }

    setOffset(offset) {
        this.offset = offset;
    }

    getTranslateRoute() {
        return "chart.labels";
    }

    setTitles() {
        return this.titles.map((title) =>
            this.translate(`${this.getTranslateRoute()}[${title}]`)
        );
    }

    setDates() {
        const currentTime = new Date().getTime();
        const interval = 60 * 60 * 1000;

        return Array.from({ length: this.offset }, (_, i) => {
            const date = new Date(
                currentTime - (this.offset - 1 - i) * interval
            );
            return date.getTime();
        });
    }

    setDefaultKeys() {
        this.graph = {
            ...this.graph,
            title: this.setTitles(),
            dates: this.setDates(),
        };
    }

    randomizeTest(min, max) {
        return Math.random() * (max - min) + min;
    }

    validateHashrate(hash, unit) {
        let hashrate = hash ?? 0;
        if (unit === HashrateUnitEnum.petahash) hashrate *= 1000;
        else if (unit === HashrateUnitEnum.exsahash) hashrate *= 1000000;

        return hashrate;
    }

    async makeFullValues() {
        const [values, amount, unit] = this.records.slice(-this.offset).reduce(
            (acc, el) => {
                let hashrate = this.validateHashrate(el.hashrate, el.unit);
                acc[0].push(Number(hashrate));
                el.amount ? acc[1].push(el.amount) : acc[1].push(0);
                acc[2].push(HashrateUnitEnum.terahash);

                return acc;
            },
            [[], [], []]
        );

        while (values.length < this.offset) {
            values.push(0);
            amount.push("0");
            unit.push(HashrateUnitEnum.terahash);
        }

        Object.assign(this.graph, {
            values: values.reverse(),
            amount: amount.map(String).reverse(),
            unit: unit.reverse(),
        });
    }

    async makeFullBarValues() {
        const [amount] = this.records.slice(-this.offset).reduce(
            (acc, el) => {
                acc[0].push(el.amount);

                return acc;
            },
            [[], [], []]
        );

        while (amount.length < 30) {
            amount.push(0);
        }

        Object.assign(this.graph, {
            values: amount.reverse(),
        });
    }
}
