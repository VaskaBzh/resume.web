export class incomeData {
    constructor(
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
        this.date = date;
        this.datePay = datePay;
        this.hash = `${hash} ${unit}`;
        this.earn = earn;
        this.wallet = wallet;
        this.status = status;
        this.message = message;
        this.class = className;
    }
}
