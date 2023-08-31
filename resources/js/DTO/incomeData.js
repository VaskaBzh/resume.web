export class incomeData {
    constructor(
        type,
        date,
        datePay,
        hash,
        unit,
        earn,
        wallet,
        status,
        message,
        className
    ) {
        this.type = type;
        this.date = date;
        this.datePay = datePay;
        this.hash = `${hash} ${unit}h/s`;
        this.earn = `${earn} BTC`;
        this.wallet = wallet;
        this.status = status;
        this.message = message;
        this.class = className;
    }
}
