export class Profit {
    constructor(hash, fpps, diff, reward) {
        this.hash = Number(hash);
        this.fpps = Number(fpps);
        this.diff = diff;
        this.reward = reward;
    }

    amount() {
        return (
            (this.hash * Math.pow(10, 12) * 86400 * (this.reward + this.fpps)) /
            (this.diff * Math.pow(2, 32))
        );
    }
}
