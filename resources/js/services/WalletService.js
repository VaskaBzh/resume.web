import api from "@/api/api";

import { walletData } from "@/DTO/walletData";

export class WalletService {
    constructor(group_id, translate, titles) {
        this.group_id = group_id;
        this.titles = titles;

        this.translate = translate;
    }


//     if (this.isChecked) {
//     if (wal.payment && wal.payment !== 0) {
//     Vue.set(arr, i, walletModel);
// }
// } else {
//     Vue.set(arr, i, walletModel);
// }

    setTitles() {
        return this.titles.map((title) =>
            this.translate(`chart.labels[${title}]`)
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

    async makeFullValues() {
        const [values, amount, unit] = this.records.slice(-this.offset).reduce(
            (acc, el) => {
                let hashrate = el.hashrate ?? 0;
                if (el.unit === "P") hashrate *= 1000;
                else if (el.unit === "E") hashrate *= 1000000;
                acc[0].push(Number(hashrate));
                el.amount ? acc[1].push(el.amount) : acc[1].push(0);
                acc[2].push("T");

                return acc;
            },
            [[], [], []]
        );

        while (values.length < this.offset) {
            values.push(0);
            amount.push("0");
            unit.push("T");
        }

        Object.assign(this.graph, {
            values: values.reverse(),
            amount: amount.map(String).reverse(),
            unit: unit.reverse(),
        });
    }

    async fetch() {
        return await api.get(
            `/api/hashrate/${this.group_id}?offset=${this.offset}`
        );
    }

    async index() {
        this.waitHashrate = true;

        this.setDefaultKeys();

        this.records = (await this.fetch()).data.data.map((el) => {
            return new subHashrateData(el);
        });

        await this.makeFullValues();

        this.waitHashrate = false;
    }
}
