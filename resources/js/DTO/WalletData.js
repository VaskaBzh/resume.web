import { UnitEnum } from "@/modules/common/enums/UnitEnum";


export class WalletData {
    constructor(walletRecord) {
        this.wallet_address = walletRecord.wallet;
        this.fullName = walletRecord.fullName;
        this.name = walletRecord.name;
        this.currency = UnitEnum.bitcoin;
        this.total_payout = walletRecord.total_payout;
        this.percent = walletRecord.percent;
        this.minWithdrawal = walletRecord.minWithdrawal;
    }
}
