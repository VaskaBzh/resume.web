import { DefaultSubsService } from "./DefaultSubsService";
import { HashrateUnitEnum } from "../../enums/HashrateUnitEnum";

export class GraphDataService extends DefaultSubsService {
    constructor(offset = 96) {
        super();
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

    // getTranslateRoute() {
    //     return "chart.labels";
    // }

    // setTitles() {
    //     return this.titles.map((title) =>
    //         this.translate(`${this.getTranslateRoute()}[${title}]`)
    //     );
    // }

    setDates(interval = 60 * 60 * 1000) {
        const currentTime = new Date().getTime();

        return Array.from({ length: this.offset }, (_, i) => {
            const date = new Date(
                currentTime - (this.offset - 1 - i) * interval
            );
            return date.getTime();
        });
    }

    setDefaultKeys(interval) {
        // title: this.setTitles(),
        this.graph = {
            ...this.graph,
            dates: this.setDates(interval),
        };
    }

    randomizeTest(min, max) {
        return Math.random() * (max - min) + min;
    }

    async makeFullValues() {
        const [values, amount, unit] = this.records.slice(-this.offset).reduce(
            (acc, el) => {
                acc[0].push(el.hashrate || 0);
                acc[1].push(el.amount || 0);
                acc[2].push(el.unit || "T");

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
                acc[0].push(el.amount || 0);

                return acc;
            },
            [[]]
        );

        while (amount.length < 30) {
            amount.push(0);
        }

        Object.assign(this.graph, {
            values: amount.reverse(),
        });
    }
}
