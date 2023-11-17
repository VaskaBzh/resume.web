export class Profit {
    constructor(hash, diff, reward, fpps) {
        this.hash = Number(hash);
        this.diff = diff;
        this.reward = reward;
        this.fppsPercent = fpps;
    }

    calculatorAmount(interval) {
        const seconds = 3600 * interval;
        const btcComFee = 0.5;
        const allBtcFee = 3.5;
        const earnTime =
            (this.diff * Math.pow(2, 32)) /
            (this.hash * Math.pow(10, 12) * seconds);

        const total = this.reward / earnTime;

        const totalWithFppsPercent = total + total * (this.fppsPercent / 100);

        return totalWithFppsPercent - totalWithFppsPercent * ((btcComFee + allBtcFee) / 100);
    }
}
