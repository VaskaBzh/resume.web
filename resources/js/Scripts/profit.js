export class Profit {
    constructor(hash, diff, reward, fpps) {
        this.hash = Number(hash);
        this.diff = diff;
        this.reward = reward;
        this.fppsPercent = fpps;
    }

    lightCalculatorAmount(interval) {
        const seconds = 3600 * interval;
        const btcComFee = 0.5;
        const allBtcFee = 3.5;
        let earnTime =
            (this.diff * Math.pow(2, 32)) /
            (this.hash * Math.pow(10, 12) * seconds);

        let total = this.reward / earnTime;
        return (
            total + total * ((this.fppsPercent - btcComFee - allBtcFee) / 100)
        );
    }
}
