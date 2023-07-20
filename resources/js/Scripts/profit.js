export class Profit {
    constructor(hash, diff, reward) {
        this.hash = Number(hash);
        this.diff = diff;
        this.reward = reward;
    }

    amount() {
        return (
            (this.hash * Math.pow(10, 12) * 86400 * this.reward) /
            (this.diff * Math.pow(2, 32))
        );
    }
}
